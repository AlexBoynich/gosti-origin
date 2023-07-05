<?php

namespace App\Filament\Resources;

use App\Enums\NavigationGroupEnum;
use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationGroup = NavigationGroupEnum::CONTACT_INFORMATION->value;

    protected static ?string $label = 'Контакты';
    protected static ?string $pluralLabel = 'Контакты';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static bool $shouldRegisterNavigation = false;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->mask(fn(Mask $mask) => $mask->pattern('+{7}(000)000-00-00'))
                            ->placeholder('+7')
                            ->tel()
                            ->autofocus()
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required(),

                        Forms\Components\TextInput::make('vk')
                            ->helperText('Адрес должен содержать http:// или https:// протоколы')
                            ->url()
                            ->required(),

                        Forms\Components\TextInput::make('whatsapp')
                            ->helperText('Адрес должен содержать http:// или https:// протоколы')
                            ->url()
                            ->required(),

                        Forms\Components\TextInput::make('gis')
                            ->helperText('Адрес должен содержать http:// или https:// протоколы')
                            ->url()
                            ->required(),

                        Forms\Components\TextInput::make('address')
                            ->string()
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('phone')
                    ->limit(10),
                Tables\Columns\TextColumn::make('email')
                    ->limit(10),
                Tables\Columns\TextColumn::make('vk')
                    ->limit(10),
                Tables\Columns\TextColumn::make('whatsapp')
                    ->limit(10),
                Tables\Columns\TextColumn::make('gis')
                    ->limit(10),
                Tables\Columns\TextColumn::make('address')
                    ->limit(10),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
