<?php

namespace App\Observers\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;


class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        if (request()->image !== null) {
            $this->storeOrUploadImage($post);
        }
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updating(Post $post)
    {
        if (request()->image !== null) {
            Storage::disk('public')->delete($post->image);
            $this->storeOrUploadImage($post);
        }
        $post->author_id = auth()->user()->id;
    }

    protected function storeOrUploadImage($post)
    {
       $name = time().'.' . explode('/', explode(':', substr(request()->image, 0, strpos(request()->image, ';')))[1])[1];
       $image = request()->image;
       $key = 'posts' . '/' . $name;
       Storage::disk('public')->put($key, file_get_contents($image));
       $post->image = $key;
   }
}
