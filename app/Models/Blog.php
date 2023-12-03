<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
        'name',
        'description',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
