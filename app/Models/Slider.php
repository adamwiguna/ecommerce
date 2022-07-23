<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
