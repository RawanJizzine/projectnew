<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewsData extends Model
{
    use HasFactory;
    protected $table = 'reviews_data';
    protected $guarded = [];
     public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
