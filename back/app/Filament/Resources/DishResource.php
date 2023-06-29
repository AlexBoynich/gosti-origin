<?php

namespace App\Filament\Resources;

use App\Enums\NavigationGroupEnum;
use App\Filament\Resources\DishResource\Pages;
use App\Filament\Resources\DishResource\RelationManagers;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Metric;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class DishResource extends Resource
{
    protected static ?string $model = Dish::class;
    protected static ?string $navigationGroup = NavigationGroupEnum::DISHES->value;
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $label = 'Блюдо';
    protected static ?string $pluralLabel = 'Блюда';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    TextInput::make('title')
                        ->string()
                        ->required()
                        ->autofocus()
                        ->label('Наименование'),

                    TextInput::make('composition')
                        ->string()
                        ->required()
                        ->label('Состав'),

                    TextInput::make('price')
                        ->default(0)
                        ->integer()
                        ->required()
                        ->label('Цена'),

                    Select::make('metric_id')
                        ->options(Metric::all()
                            ->pluck('title', 'id')
                        )
                        ->placeholder('Выбрать')
                        ->label('Ед. измерения')
                        ->required(),

                    TextInput::make('metric_value')
                        ->default(0)
                        ->integer()
                        ->label('Вес/объём')
                        ->required(),

                    Select::make('category_id')
                        ->options(function (callable $get) {
                            if (is_null($get('category_id'))) {
                                return Category::all()->pluck('title', 'id');
                            }
                            return Category::query()->find($get('category_id'))->pluck('title', 'id');
                        })
                        ->afterStateUpdated(null)
                        ->reactive()
                        ->placeholder('Не выбрано')
                        ->label('Категория')
                        ->required(),

                    Select::make('subcategory_id')
                        ->options(function (callable $get) {
                            $category = Category::query()->find($get('category_id'));
                            return is_null($category) ? [] : $category->subcategories->pluck('title', 'id');
                        })
                        ->reactive()
                        ->placeholder('Не выбрано')
                        ->label('Подкатегория')
                        ->required(),

                    TextInput::make('calorie')
                        ->default(0)
                        ->integer()
                        ->required()
                        ->label('Калорийность'),

                    TextInput::make('proteins')
                        ->default(0)
                        ->integer()
                        ->required()
                        ->label('Белки'),

                    TextInput::make('fats')
                        ->default(0)
                        ->integer()
                        ->required()
                        ->label('Жиры'),

                    TextInput::make('carbohydrates')
                        ->default(0)
                        ->integer()
                        ->required()
                        ->label('Углеводы'),

                    Checkbox::make('is_available')
                        ->default(true)
                        ->label('Доступно для заказа'),

                    Checkbox::make('sugar')
                        ->label('С сахаром'),

                    Checkbox::make('lactose')
                        ->label('С лактозой'),

                    Checkbox::make('gluten')
                        ->label('С глютеном'),

                    SpatieMediaLibraryFileUpload::make('preview')
                        ->collection('dishes')
                        ->label('Изображение'),
                ])->inlineLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('preview')
                    ->collection('dishes')
                    ->label('Изображение'),
                TextColumn::make('title')
                    ->label('Блюдо')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('price')
                    ->label('Цена')
                    ->money('rub')
                    ->toggleable(),
                TextColumn::make('calorie')
                    ->label('К')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->tooltip('Калории'),
                TextColumn::make('proteins')
                    ->label('Б')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->tooltip('Белки'),
                TextColumn::make('fats')
                    ->label('Ж')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->tooltip('Жиры'),
                TextColumn::make('carbohydrates')
                    ->label('У')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->tooltip('Углеводы'),
                TextColumn::make('composition')
                    ->label('Состав')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(),
                ToggleColumn::make('is_available')
                    ->label('Доступно')
                    ->toggleable(),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                ]),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListDishes::route('/'),
            'create' => Pages\CreateDish::route('/create'),
            'view' => Pages\ViewDish::route('/{record}'),
            'edit' => Pages\EditDish::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

