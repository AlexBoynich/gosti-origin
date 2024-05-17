<?php

namespace App\Filament\Resources;

use App\Enums\NavigationGroupEnum;
use App\Filament\Resources\SubcategoryResource\Pages;
use App\Filament\Resources\SubcategoryResource\RelationManagers;
use App\Models\Dish;
use App\Models\Subcategory;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubcategoryResource extends Resource
{
    protected static ?string $model = Subcategory::class;
    protected static ?string $navigationGroup = NavigationGroupEnum::DISHES->value;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $label = 'Подкатегория';
    protected static ?string $pluralLabel = 'Подкатегории';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Select::make('category_id')
                        ->relationship('category', 'title')
                        ->placeholder('Выбрать')
                        ->required()
                        ->autofocus()
                        ->label('Родительская категория'),

                    TextInput::make('title')
                        ->minLength(1)
                        ->maxLength(20)
                        ->string()
                        ->required()
                        ->label('Подкатегория'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('title')
                    ->searchable()
                    ->label('Подкатегория'),
                TextColumn::make('category.title')
                    ->label('Категория'),
            ])
            ->filters([
                SelectFilter::make('parentCategory')
                    ->relationship('category', 'title')
                    ->label('Категория')
            ])
            ->actions([
                Tables\Actions\Action::make('subcatergory')
                    ->label(function (Subcategory $record) {
                        $availableDishesCount = Dish::where([
                            'subcategory_id' => $record->id,
                            'is_available' => true
                        ])->count();
                        return $availableDishesCount ? 'Добавить в стоплист' : 'Убрать из стоплиста';
                    })
                    ->hidden(function(Subcategory $record) {
                        return !Dish::where('subcategory_id', $record->id)->count();
                    })
                    ->color('warning')
                    ->action(function (Subcategory $record) {
                        $dishes = Dish::where('subcategory_id', $record->id)->get();

                        $dishesNotInStoplist = $dishes->where('is_available', true);
                        $isAvailable = !(count($dishesNotInStoplist) > 0);

                        foreach ($dishes as $dish) {
                            $dish->update([
                                'is_available' => $isAvailable
                            ]);
                        }
                    }),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSubcategories::route('/'),
            'create' => Pages\CreateSubcategory::route('/create'),
            'edit' => Pages\EditSubcategory::route('/{record}/edit'),
        ];
    }
}
