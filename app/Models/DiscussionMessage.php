<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionMessage extends Model
{
    use HasFactory;
    protected $table = 'discussion_messages';
    protected $guarded = [];
}
