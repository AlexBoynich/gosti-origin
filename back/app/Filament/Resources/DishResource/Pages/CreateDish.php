<?php

namespace App\Filament\Resources\DishResource\Pages;

use App\Filament\Resources\DishResource;
use App\Models\Category;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDish extends CreateRecord
{
    protected static string $resource = DishResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (is_null($data['metric_id'])){
            unset($data['metric_value']);
        } elseif (!is_null($data['metric_id']) && is_null($data['metric_value'])) {
            Notification::make()
                ->danger()
                ->title('Ошибка')
                ->body("Если что-то выбрано в поле 'Ед. измерения', необходимо добавить значение в поле 'Вес/объём'")
                ->seconds(5)
                ->send();
            $this->halt();
        }
        return $data;
    }
}
