<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'review';
    protected $guarded = [];
    public function reviewsData()
    {
        return $this->hasMany(ReviewsData::class);
    }
}
