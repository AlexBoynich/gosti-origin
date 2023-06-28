<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'priority',
        'available_start',
        'available_end',
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
