<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamData extends Model
{
    use HasFactory;
    protected $table = 'teams_data';
    protected $guarded = [];
    public function teams()
    {
        return $this->belongsTo(TeamModel::class);
    }
}
