<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturesData extends Model
{
    use HasFactory;
    protected $table = 'features_data';
    protected $guarded = [];
    public function features()
    {
        return $this->belongsTo(Feature::class);
    }
}
