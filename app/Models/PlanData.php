<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanData extends Model
{
    use HasFactory;
    protected $table = 'plan_data';
    protected $guarded = [];
    public function planLists()
    {
        return $this->hasMany(PlanList::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    
}
