<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterEmail extends Model
{
    use HasFactory;
    protected $table = 'letter_emails';
    protected $guarded = [];
}
