<?php

namespace App\Filament\Resources\DishResource\Pages;

use App\Filament\Resources\DishResource;
use App\Models\Category;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDish extends CreateRecord
{
    protected static string $resource = DishResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
