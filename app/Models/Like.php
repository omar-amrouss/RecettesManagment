<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    public $timestamps = false;

    public $fillable = ['author_id', 'recipe_id'];
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }
}
