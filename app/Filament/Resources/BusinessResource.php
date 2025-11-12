<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Business;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BusinessResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\BusinessResource\RelationManagers;

class BusinessResource extends Resource
{
    protected static ?string $model = Business::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Business Management';
    protected static ?string $pluralModelLabel = 'Businesses';
    protected static ?string $modelLabel = 'Business';

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

        return $query->whereHas('owner', function ($query) use ($user) {
            $query->where('owner_id', $user->id);
        });
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Forms\Components\Hidden::make('owner_id')
                    ->default(fn() => Filament::auth()->id()),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->numeric()
                    ->maxLength(14),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),

                SpatieMediaLibraryFileUpload::make('logo')
                    ->label('logo')
                    ->collection('logo'),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Unit Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('address')
                    ->label('Address'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusinesses::route('/'),
            'create' => Pages\CreateBusiness::route('/create'),
            'edit' => Pages\EditBusiness::route('/{record}/edit'),
        ];
    }
}
