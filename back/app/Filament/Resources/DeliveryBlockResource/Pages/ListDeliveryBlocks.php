<?php

namespace App\Filament\Resources\DeliveryBlockResource\Pages;

use App\Filament\Resources\DeliveryBlockResource;
use App\Models\Block;
use App\Models\Target;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDeliveryBlocks extends ListRecords
{
    protected static string $resource = DeliveryBlockResource::class;

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

    protected function getTableQuery(): Builder
    {
        $target = Target::query()->firstOrCreate(['title' => 'доставка']);
        return Block::query()->where('target_id', $target->id);
    }
}
