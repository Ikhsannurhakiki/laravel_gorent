<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Unit;
use App\Models\UnitType;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UnitResource\Pages;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;

class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Business Management';
    protected static ?string $pluralModelLabel = 'Units';
    protected static ?string $modelLabel = 'Unit';

    /**
     * Limit visible records based on user role.
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Filament::auth()->user();

        // If no authenticated user, return no records
        if (! $user) {
            return $query->whereRaw('0 = 1');
        }

        // Admin sees all — support both hasRole and common user attributes
        if ((method_exists($user, 'hasRole') && $user->hasRole('admin'))
            || (property_exists($user, 'role') && $user->role === 'admin')
            || (isset($user->is_admin) && $user->is_admin)
        ) {
            return $query;
        }

        return $query->whereHas('business', function ($query) use ($user) {
            $query->where('owner_id', $user->id);
        });
    }

    /**
     * Define the form for create/edit.
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Unit Information')->schema([
                Grid::make(2)->schema([
                    Select::make('business_id')
                        ->label('Business')
                        ->relationship('business', 'name')
                        ->required()
                        ->options(function () {
                            $user = Filament::auth()->user();
                            return \App\Models\Business::where('owner_id', $user->id)
                                ->pluck('name', 'id');
                        }),

                    Select::make('type')
                        ->label('Unit Type')
                        ->relationship('unitType', 'name')
                        ->required()
                        ->preload()
                        ->searchable()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Textarea::make('description')
                                ->maxLength(65535),
                            TextInput::make('icon')
                                ->maxLength(255),
                        ]),

                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Textarea::make('description')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ]),
            ]),

            Section::make('Location Information')->schema([
                Grid::make(3)->schema([
                    TextInput::make('location_name')
                        ->label('Location Name')
                        ->maxLength(255),

                    TextInput::make('latitude')
                        ->numeric()
                        ->step(0.0000001)
                        ->minValue(-90)
                        ->maxValue(90),

                    TextInput::make('longitude')
                        ->numeric()
                        ->step(0.0000001)
                        ->minValue(-180)
                        ->maxValue(180),
                ]),
            ])->collapsible(),

            Section::make('Media & Settings')->schema([
                Grid::make(2)->schema([
                    Toggle::make('is_available')
                        ->label('Available for Booking')
                        ->default(true)
                        ->required(),

                    SpatieTagsInput::make('tags')
                        ->type('unit_tags')
                        ->columnSpanFull(),
                ]),

                SpatieMediaLibraryFileUpload::make('thumbnail')
                    ->label('Thumbnail Image')
                    ->collection('thumbnail')
                    ->image()
                    ->imageEditor()
                    ->required()
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('gallery')
                    ->label('Gallery Images')
                    ->collection('gallery')
                    ->multiple()
                    ->image()
                    ->imageEditor()
                    ->reorderable()
                    ->columnSpanFull(),
            ]),
        ]);
    }

    /**
     * Define the table for listing.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('business.name')
                    ->label('Business')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('unitType.name')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Unit Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('location_name')
                    ->label('Location')
                    ->sortable()
                    ->searchable()
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    }),

                IconColumn::make('is_available')
                    ->boolean()
                    ->sortable()
                    ->label('Available'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('business')
                    ->relationship('business', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('type')
                    ->relationship('unitType', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\TernaryFilter::make('is_available')
                    ->label('Availability')
                    ->boolean()
                    ->trueLabel('Available')
                    ->falseLabel('Not Available'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('markAvailable')
                        ->label('Mark as Available')
                        ->action(fn($records) => $records->each->update(['is_available' => true]))
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('markUnavailable')
                        ->label('Mark as Unavailable')
                        ->action(fn($records) => $records->each->update(['is_available' => false]))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    /**
     * Pages for CRUD navigation.
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnits::route('/'),
            'create' => Pages\CreateUnit::route('/create'),
            'edit' => Pages\EditUnit::route('/{record}/edit'),
        ];
    }
}
