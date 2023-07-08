<?php

namespace App\Filament\Resources;

use App\Enums\NavigationGroupEnum;
use App\Enums\TargetEnums;
use App\Filament\Resources\AboutBlockResource\Pages;
use App\Filament\Resources\AboutBlockResource\RelationManagers;
use App\Models\AboutBlock;
use App\Models\Block;
use App\Models\Target;
use Filament\Forms\Components\RichEditor;
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

class AboutBlockResource extends Resource
{
    protected static ?string $model = Block::class;
    protected static ?string $navigationGroup = NavigationGroupEnum::BLOCKS->value;

    protected static ?string $label = 'О нас';
    protected static ?string $pluralLabel = 'О нас';
    protected static ?string $slug = 'about-block';
    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Заголовок')
                    ->required(),
                RichEditor::make('description')
                    ->label('Описание')
                    ->required()
                    ->toolbarButtons([
                        //
                    ]),
                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('about')
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
                        ->collection('about')
                        ->label('Изображение'),
                    TextColumn::make('title')
                        ->label('Заголовок'),
                ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
                    ->before(function (DeleteAction $action) {
                        $target = Target::query()->firstWhere('title', TargetEnums::ABOUT->value);
                        $count = Block::query()->where('target_id', $target->id)->count();

                        if ($count == 1) {
                            Notification::make()
                                ->warning()
                                ->title('Ошибка')
                                ->body('Невозможно удалить: должна существовать минимум 1 запись')
                                ->seconds(5)
                                ->send();
                            $action->cancel();
                        }
                    }),
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
            'index' => Pages\ListAboutBlocks::route('/'),
            'create' => Pages\CreateAboutBlock::route('/create'),
        ];
    }
}
