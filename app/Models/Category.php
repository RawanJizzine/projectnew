<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [] ;
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'category_user');
    }
}
