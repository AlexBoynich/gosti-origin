<?php

namespace App\Filament\Resources;

use App\Enums\NavigationGroupEnum;
use App\Enums\TargetEnums;
use App\Filament\Resources\DeliveryBlockResource\Pages;
use App\Filament\Resources\DeliveryBlockResource\RelationManagers;
use App\Models\Block;
use App\Models\DeliveryBlock;
use App\Models\Target;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeliveryBlockResource extends Resource
{
    protected static ?string $model = Block::class;
    protected static ?string $navigationGroup = NavigationGroupEnum::BLOCKS->value;

    protected static ?string $label = 'Доставка';

    protected static ?string $pluralLabel = 'Доставка';

    protected static ?string $slug = 'delivery-block';

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Заголовок')
                    ->required(),
                Textarea::make('description')
                    ->label('Описание')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('image')
                    ->collection('delivery')
                    ->image()
                    ->label('Изображение')
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    SpatieMediaLibraryImageColumn::make('image')
                        ->collection('delivery')
                        ->label('Изображение'),
                    TextColumn::make('title')
                        ->label('Заголовок')
                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListDeliveryBlocks::route('/'),
            'create' => Pages\CreateDeliveryBlock::route('/create'),
        ];
    }
}
