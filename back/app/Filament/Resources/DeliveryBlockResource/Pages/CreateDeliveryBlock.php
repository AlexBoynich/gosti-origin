<?php

namespace App\Filament\Resources\DeliveryBlockResource\Pages;

use App\Enums\TargetEnums;
use App\Filament\Resources\DeliveryBlockResource;
use App\Models\Block;
use App\Models\Target;
use App\Traits\BlockTrait;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeliveryBlock extends CreateRecord
{
    use BlockTrait;

    protected static string $resource = DeliveryBlockResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['target_id'] = $this->getTargetId(TargetEnums::DELIVERY);

        return $data;
    }

    protected function beforeCreate(): void
    {
        $count = Block::query()->where('target_id', $this->getTargetId(TargetEnums::DELIVERY))->count();

        if ($count > 0) {
            Notification::make()
                ->warning()
                ->title('Ошибка')
                ->body('Запись уже существует')
                ->seconds(5)
                ->send();
            $this->halt();
        }
    }
}
