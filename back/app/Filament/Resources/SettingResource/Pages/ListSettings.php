<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Enums\SectionEnums;
use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getActions(): array
    {
        return [
            //
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    public function getTableQuery(): Builder
    {
        return Setting::query()->where('section', SectionEnums::MAIN->value);
    }
}
