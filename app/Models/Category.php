<?php

namespace App\Models;

use App\Models\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'slug', 'user_id'];

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function posts()
    {
    	return $this->belongsToMany(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
