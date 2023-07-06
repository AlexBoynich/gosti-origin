<?php

namespace App\Http\Controllers\Api;

use App\Enums\ErrorEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\DishResource;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DishController extends Controller
{
    public function index()
    {
        try {
            return DishResource::collection(Dish::all());
        } catch (\Exception $exception) {
            Log::critical($exception->getMessage());
            return response([
                'success' => false,
                'message' => ErrorEnum::UNKNOWN->value,
            ]);
        }
    }
}
