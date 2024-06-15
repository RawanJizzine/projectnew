<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $guarded = [];
    public function filesPatientInfo()
    {
        return $this->hasMany(FilePatient::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
