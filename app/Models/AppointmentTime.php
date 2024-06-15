<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTime extends Model
{
    use HasFactory;
    protected $table = 'appointment_times';
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
