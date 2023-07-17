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
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Component as Livewire;


class DishResource extends Resource
{
    protected static ?string $model = Dish::class;
    protected static ?string $navigationGroup = NavigationGroupEnum::DISHES->value;
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $label = 'Блюдо';
    protected static ?string $pluralLabel = 'Блюда';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    TextInput::make('title')
                        ->minLength(1)
                        ->maxLength(100)
                        ->string()
                        ->required()
                        ->autofocus()
                        ->label('Наименование'),

                    TextInput::make('composition')
                        ->minLength(1)
                        ->maxLength(150)
                        ->string()
                        ->required()
                        ->label('Состав'),

                    TextInput::make('price')
                        ->default(0)
                        ->maxLength(10)
                        ->maxValue(9999999999)
                        ->mask(fn(TextInput\Mask $mask) => $mask->pattern('[0000000000]'))
                        ->integer()
                        ->required()
                        ->label('Цена'),

                    Select::make('metric_id')
                        ->options(Metric::all()->pluck('title', 'id'))
                        ->reactive()
                        ->default(3)
                        ->afterStateUpdated(function ($state ,callable $set) {
                            if (is_null($state)) {
                                $set('metric_value', null);
                            }
                        })
                        ->label('Ед. измерения'),

                    TextInput::make('metric_value')
                        ->maxLength(10)
                        ->maxValue(9999999999)
                        ->mask(fn(TextInput\Mask $mask) => $mask->pattern('[0000000000]'))
                        ->integer()
                        ->label('Вес/объём'),

                    Select::make('category_id')
                        ->options(function (callable $get) {
                            if (is_null($get('category_id'))) {
                                return Category::all()->pluck('title', 'id');
                            }
                            return Category::query()->find($get('category_id'))->pluck('title', 'id');
                        })
                        ->afterStateUpdated(fn(callable $set) => $set('subcategory_id', null))
                        ->reactive()
                        ->label('Категория')
                        ->required(),

                    Select::make('subcategory_id')
                        ->options(function (callable $get) {
                            $category = Category::query()->find($get('category_id'));
                            return is_null($category) ? [] : $category->subcategories->pluck('title', 'id');
                        })
                        ->reactive()
                        ->required()
                        ->label('Подкатегория'),

                    TextInput::make('calorie')
                        ->maxLength(10)
                        ->maxValue(9999999999)
                        ->mask(fn(TextInput\Mask $mask) => $mask->pattern('[0000000000]'))
                        ->default(0)
                        ->integer()
                        ->required()
                        ->label('Калорийность'),

                    TextInput::make('proteins')
                        ->maxLength(10)
                        ->maxValue(9999999999)
                        ->mask(fn(TextInput\Mask $mask) => $mask->pattern('[0000000000]'))
                        ->default(0)
                        ->integer()
                        ->required()
                        ->label('Белки'),

                    TextInput::make('fats')
                        ->maxLength(10)
                        ->maxValue(9999999999)
                        ->mask(fn(TextInput\Mask $mask) => $mask->pattern('[0000000000]'))
                        ->default(0)
                        ->integer()
                        ->required()
                        ->label('Жиры'),

                    TextInput::make('carbohydrates')
                        ->maxLength(10)
                        ->maxValue(9999999999)
                        ->mask(fn(TextInput\Mask $mask) => $mask->pattern('[0000000000]'))
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
                        ->maxSize(10485760)
                        ->acceptedFileTypes([
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                            'image/svg',
                        ])
                        ->maxFiles(1)
                        ->required()
                        ->label('Изображение'),
                ])->inlineLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                SpatieMediaLibraryImageColumn::make('preview')
                    ->collection('dishes')
                    ->label('Изображение'),
                TextColumn::make('title')
                    ->label('Блюдо')
                    ->searchable(),
                TextColumn::make('subcategory.title')
                    ->label('Подкатегория'),
                TextColumn::make('subcategory.category.title')
                    ->label('Категория'),
                ToggleColumn::make('is_available')
                    ->label('Доступно'),
                TextColumn::make('created_at')
                    ->visible(false)
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        Forms\Components\Fieldset::make()->schema([
                            Forms\Components\DatePicker::make('created_from')->label('С:'),
                            Forms\Components\DatePicker::make('created_until')->label('До:'),
                        ])->columns(1)->label('Дата создания'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                SelectFilter::make('subcategory')->form(
                    [
                        Forms\Components\Fieldset::make()->schema([
                            Select::make('category')
                                ->options(Category::all()->pluck('title', 'id'))
                                ->afterStateUpdated(null)
                                ->disablePlaceholderSelection()
                                ->label('Категория'),
                            Select::make('subcategory')
                                ->options(function (callable $get) {
                                    $category = Category::query()->find($get('category'));
                                    return is_null($category) ? [] : $category->subcategories->pluck('title', 'id');
                                })
                                ->reactive()
                                ->label('Подкатегория')
                        ])->columns(1)->label('Подкатегория'),
                    ]
                )
                    ->query(function (Builder $query, $data) {
                        return $query->when(
                            $data['subcategory'],
                            fn(Builder $query, $subcategory) => $query->where('subcategory_id', $subcategory)
                        );
                    }),
                Filter::make('is_available')
                    ->query(fn(Builder $query) => $query->where('is_available', false))
                    ->toggle()
                    ->label('В стоп листе'),
                Filter::make('sugar')
                    ->query(fn(Builder $query) => $query->where('sugar', false))
                    ->toggle()
                    ->label('Без сахара'),
                Filter::make('lactose')
                    ->query(fn(Builder $query) => $query->where('lactose', false))
                    ->toggle()
                    ->label('Без лактозы'),
                Filter::make('gluten')
                    ->query(fn(Builder $query) => $query->where('gluten', false))
                    ->toggle()
                    ->label('Без глютена')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
}

