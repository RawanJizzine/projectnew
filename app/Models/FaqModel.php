<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqModel extends Model
{
    use HasFactory;
    protected $table = 'faq_dynamic';
    protected $guarded = [];
    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }
}
