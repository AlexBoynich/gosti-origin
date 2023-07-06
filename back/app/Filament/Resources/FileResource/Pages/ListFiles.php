<?php

namespace App\Filament\Resources\FileResource\Pages;

use App\Enums\SectionEnums;
use App\Filament\Resources\FileResource;
use App\Models\Block;
use App\Models\Setting;
use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;

class ListFiles extends ListRecords
{
    protected static string $resource = FileResource::class;

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
        return Setting::query()->where('section', SectionEnums::FILES->value);
    }
}
