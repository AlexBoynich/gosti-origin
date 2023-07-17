<?php

namespace App\Filament\Resources\DishResource\Pages;

use App\Filament\Resources\DishResource;
use App\Models\Dish;
use App\Models\Subcategory;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDish extends EditRecord
{
    protected static string $resource = DishResource::class;

    protected function getActions(): array
    {
        return [
            //
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $subcategoryId = $data['subcategory_id'];
        $category = Subcategory::query()->find($subcategoryId)->category;
        $data['category_id'] = $category->id;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (is_null($data['metric_id'])){
            unset($data['metric_value']);
        } elseif (!is_null($data['metric_id']) && is_null($data['metric_value'])) {
            Notification::make()
                ->warning()
                ->title('Ошибка')
                ->body("Если что-то выбрано в поле 'Ед. измерения', необходимо добавить значение в поле 'Вес/объём'")
                ->seconds(5)
                ->send();
            $this->halt();
        }
        return $data;
    }
}
