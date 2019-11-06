<?php

namespace App\Observers\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
     public function creating(Post $post)
    {
        if (request()->image !== null) {
            $name = time().'.' . explode('/', explode(':', substr(request()->image, 0, strpos(request()->image, ';')))[1])[1];
            $image = request()->image;
            $key = 'posts' . '/' . $name;
            Storage::disk('public')->put($key, file_get_contents($image));
            $post->image = $key;
        }
    }
}
