<?php

namespace App\Models;

use App\Models\Category;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function author()
    {
    	return $this->belongsTo(User::class, 'author_id');
    }
}
