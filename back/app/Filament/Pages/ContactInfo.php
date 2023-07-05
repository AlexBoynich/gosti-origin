<?php

namespace App\Filament\Pages;

use App\Models\Contact;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Pages\Actions\Action;
use Illuminate\Contracts\View\View;

class ContactInfo extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $label = 'Контакты';
    protected static ?string $navigationLabel = 'Контакты';

    protected ?string $heading = 'Контакты';
    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static string $view = 'filament.pages.contact-info';

    protected static ?string $navigationGroup = 'Контактная информация';

    public ?Contact $contact;

    public $data;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->contact = Contact::query()->first();
    }

    protected function getActions(): array
    {
        return [
            Action::make('saveContact')->action('save')->label('Сохранить'),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('phone')
                ->mask(fn(Mask $mask) => $mask->pattern('+{7}(000)000-00-00'))
                ->placeholder('+7')
                ->tel()
                ->label('Телефон')
                ->autofocus(),

            TextInput::make('email')
                ->email()
                ->label('Почта'),

            TextInput::make('vk')
                ->helperText('Адрес должен содержать http:// или https:// протоколы')
                ->label('Вк')
                ->url(),

            TextInput::make('whatsapp')
                ->helperText('Адрес должен содержать http:// или https:// протоколы')
                ->label('WhatsApp')
                ->url(),

            TextInput::make('gis')
                ->helperText('Адрес должен содержать http:// или https:// протоколы')
                ->label('2Gis')
                ->url(),

            TextInput::make('address')
                ->label('Адрес')
                ->string()
        ];
    }

    public function mount(): void
    {
        $this->form->fill([
            'phone' => $this->contact->phone ?? '',
            'email' => $this->contact->email ?? '',
            'vk' => $this->contact->vk ?? '',
            'whatsapp' => $this->contact->whatsapp ?? '',
            'gis' => $this->contact->gis ?? '',
            'address' => $this->contact->address ?? '',
        ]);
    }

    protected function getFormModel(): string
    {
        return Contact::class;
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    public function save()
    {
        $data = $this->form->getState();

        if (is_null($this->contact)) {
            $this->contact = Contact::query()->create($data);
        } else {
            $this->contact->update($data);
        }
        Notification::make()->title('Контакты обновлены')->success()->send();
    }
}
