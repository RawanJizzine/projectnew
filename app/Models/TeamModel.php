<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{
    use HasFactory;
    protected $table = 'team';
    protected $guarded = [];
  
    public function teamsData()
    {
        return $this->hasMany(TeamData::class);
    }
}
