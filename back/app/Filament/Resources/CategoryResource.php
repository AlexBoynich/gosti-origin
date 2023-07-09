<?php

namespace App\Filament\Resources;

use App\Enums\NavigationGroupEnum;
use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationGroup = NavigationGroupEnum::DISHES->value;

    protected static ?string $label = 'Категория';
    protected static ?string $pluralLabel = 'Категории';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('title')
                        ->required()
                        ->unique(Category::class, 'title', ignoreRecord: true)
                        ->autofocus()
                        ->label('Категория'),
                    Toggle::make('qwe')
                        ->afterStateUpdated(null),


//                    TextInput::make('priority')
//                        ->integer()
//                        ->required()
//                        ->label('Приоритет'),
//
//                    TimePicker::make('available_start')
//                        ->timezone('Asia/Tomsk')
//                        ->icon('heroicon-o-clock')
//                        ->label('Доступно с:'),
//
//                    TimePicker::make('available_end')
//                        ->timezone('Asia/Tomsk')
//                        ->icon('heroicon-o-clock')
//                        ->label('До:'),
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
                    ->label('Категория'),
//                TextColumn::make('priority')
//                    ->label('Приоритет')
//                    ->sortable(),
//                TextColumn::make('available_start')
//                    ->label('Доступно с:'),
//                TextColumn::make('available_end')
//                    ->label('Доступно до:')
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
            'index' => Pages\ListCategories::route('/'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
