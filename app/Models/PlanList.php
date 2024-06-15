<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanList extends Model
{
    use HasFactory;
    protected $table = 'list_plan';
    protected $guarded = [];
    public function planData()
    {
        return $this->belongsTo(PlanData::class);
    }
}
