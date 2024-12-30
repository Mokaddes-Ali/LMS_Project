<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'creator',
        'editor',
        'user_id',
        'price',
        'is_active',
    ];

    public function students()
{
    return $this->hasMany(CourseStudent::class);
}

}

