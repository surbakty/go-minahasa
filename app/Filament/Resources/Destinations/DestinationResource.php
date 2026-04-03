<?php

namespace App\Filament\Resources\Destinations;

use App\Filament\Resources\Destinations\Pages;
use App\Models\Destination;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Informasi Utama')
                    ->columns(2)
                    ->components([
                        \Filament\Schemas\Components\TextInput::make('name')
                            ->label('Nama Destinasi')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),

                        \Filament\Schemas\Components\TextInput::make('slug')
                            ->label('URL Slug')
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        \Filament\Schemas\Components\TextInput::make('location')
                            ->label('Lokasi')
                            ->required(),

                        \Filament\Schemas\Components\TextInput::make('price')
                            ->label('Harga Tiket')
                            ->numeric()
                            ->prefix('Rp'),
                    ]),

                \Filament\Schemas\Components\Section::make('Konten')
                    ->components([
                        \Filament\Schemas\Components\RichEditor::make('description')
                            ->required(),

                        \Filament\Schemas\Components\FileUpload::make('cover_image')
                            ->image()
                            ->directory('destinations')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('cover_image'),
                \Filament\Tables\Columns\TextColumn::make('name')->searchable(),
                \Filament\Tables\Columns\TextColumn::make('location'),
                \Filament\Tables\Columns\TextColumn::make('price')->money('IDR'),
            ])
            ->actions([
                // Menggunakan namespace aksi v4
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'edit' => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}