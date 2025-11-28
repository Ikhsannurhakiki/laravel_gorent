<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Unit;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UnitResource\Pages;
use Filament\Forms\Components\Section;
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
            Section::make()->schema([
                Forms\Components\Select::make('business_id')
                    ->label('Business')
                    ->relationship('business', 'name')
                    ->required()
                    ->options(function () {
                        $user = Filament::auth()->user();
                        return \App\Models\Business::where('owner_id', $user->id)
                            ->pluck('name', 'id');
                    }),

                Forms\Components\TextInput::make('plate_number')
                    ->required()->unique(ignorable: fn(?Unit $record) => $record)
                    ->maxLength(15),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),

                SpatieTagsInput::make('tags')->type('unit_tags'),

                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),


                Forms\Components\TextInput::make('price_per_day')
                    ->label('Price per Day')
                    ->prefix('IDR')
                    // ->mask(fn($m) => $m->money(
                    //     prefix: 'IDR ',
                    //     thousandsSeparator: '.',
                    //     decimalPlaces: 0,
                    // ))
                    ->required(),


                Forms\Components\Toggle::make('is_available')
                    ->label('Available')
                    ->default(true),

                SpatieMediaLibraryFileUpload::make('thumbnail')
                    ->label('thumbnail')
                    ->collection('thumbnail')->required(),

                SpatieMediaLibraryFileUpload::make('gallery')
                    ->label('gallery')
                    ->collection('gallery')->multiple()
            ])
        ]);
    }

    /**
     * Define the table for listing.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('plate_number')
                    ->label('Plate Number')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('business.name')
                    ->label('Business')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Unit Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->sortable()->searchable(),

                Tables\Columns\TextColumn::make('price_per_day')
                    ->label('Price / Day')
                    ->sortable()
                    ->money('IDR'),

                Tables\Columns\IconColumn::make('is_available')
                    ->boolean()
                    ->sortable()
                    ->label('Available'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
