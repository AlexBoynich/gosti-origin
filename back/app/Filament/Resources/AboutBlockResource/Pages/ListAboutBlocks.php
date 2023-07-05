<?php

namespace App\Filament\Resources\AboutBlockResource\Pages;

use App\Filament\Resources\AboutBlockResource;
use App\Models\Block;
use App\Models\Target;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAboutBlocks extends ListRecords
{
    protected static string $resource = AboutBlockResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableQuery(): Builder
    {
        $target = Target::query()->firstOrCreate(['title' => 'о нас']);
        return Block::query()->where('target_id', $target->id);
    }
}
