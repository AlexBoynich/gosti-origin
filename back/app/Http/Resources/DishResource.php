<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class DishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price / 100,
            'calories' => $this->calorie,
            'proteins' => "{$this->proteins} г",
            'fats' => "{$this->fats} г",
            'carbohydrates' => "{$this->carbohydrates} г",
            'desc' => $this->composition,
            'sugar' => $this->sugar,
            'lactose' => $this->lactose,
            'gluten' => $this->gluten,
            'weight' => "{$this->metric_value} {$this->metric->title}",
            'img' => $this->getFirstMediaUrl('dishes'),
            'isAvailabel' => $this->checkAvailable(),
        ];
    }

    private function checkAvailable(): bool
    {
        if (!$this->is_available) return false;

        $date = Carbon::now(7);
        $day = $date->dayOfWeekIso;
        $time = $date->toTimeString();

        if ($day == 6 || $day == 7) {
            $start = $this->category()->weekend_available_start;
            $end = $this->category()->weekend_available_end;
        } else {
            $start = $this->category()->weekday_available_start;
            $end = $this->category()->weekday_available_end;
        }

        if (!$this->isSetTimeLimit($start, $end)) return false;

        return $this->isTimeInRange($time,$start, $end);
    }

    private function isSetTimeLimit($start, $end): bool
    {
        if (is_null($start) || is_null($end)) {
            return false;
        }
        return true;
    }

    private function isTimeInRange($time, $startTime, $endTime)
    {
        $timeObj = Carbon::createFromFormat('H:i:s', $time);
        $startObj = Carbon::createFromFormat('H:i:s', $startTime);
        $endObj = Carbon::createFromFormat('H:i:s', $endTime);

        if ($startObj->greaterThan($endObj)) {
            $midnight = Carbon::createFromFormat('H:i:s', '23:59:59');
            return ($timeObj->between($startObj, $midnight))
                || ($timeObj->between(Carbon::createFromFormat('H:i:s', '00:00:00'), $endObj));
        } else {
            return $timeObj->between($startObj, $endObj);
        }
    }
}
