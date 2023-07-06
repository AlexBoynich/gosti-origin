<?php

namespace App\Filament\Resources\AboutBlockResource\Pages;

use App\Enums\TargetEnums;
use App\Filament\Resources\AboutBlockResource;
use App\Models\Block;
use App\Models\Target;
use App\Traits\BlockTrait;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
class CreateAboutBlock extends CreateRecord
{
    use BlockTrait;

    protected static string $resource = AboutBlockResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['target_id'] = $this->getTargetId(TargetEnums::ABOUT);

        return $data;
    }

    protected function beforeCreate(): void
    {
        $target = Target::query()->firstWhere('title', TargetEnums::ABOUT->value);
        $count = Block::query()->where('target_id', $this->getTargetId(TargetEnums::ABOUT))->count();

        if ($count >= 5) {
            Notification::make()
                ->warning()
                ->title('Ошибка')
                ->body('Максимум 5 записей')
                ->seconds(5)
                ->send();
            $this->halt();
        }
    }
}
