<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Dish extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;


    protected $fillable = [
        'title',
        'price',
        'calorie',
        'proteins',
        'fats',
        'carbohydrates',
        'composition',
        'is_available',
        'sugar',
        'lactose',
        'gluten',
        'subcategory_id',
        'metric_id',
        'metric_value',
    ];

    public function subcategory()
    {
        $this->belongsTo(Subcategory::class);
    }

    public function category()
    {
        $this->hasOneThrough(Category::class, Subcategory::class);
    }

    public function metric()
    {
        $this->belongsTo(Metric::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

}
