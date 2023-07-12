<?php

namespace App\Http\Controllers\Api;

use App\Enums\TargetEnums;
use App\Http\Controllers\Controller;
use App\Http\Resources\MainBlockResource;
use App\Models\Block;
use App\Models\Target;

class BlockController extends Controller
{
    public function mainBlock()
    {
        $target = Target::query()->firstWhere('title', TargetEnums::MAIN->value);
        $mainBlock = Block::query()->firstWhere('target_id', $target->id);
        return new MainBlockResource($mainBlock);
    }
}
