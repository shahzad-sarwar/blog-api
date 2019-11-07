<?php

namespace App\Observers\Post;

use App\Handler\Images\StoreOrUpload;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;


class PostObserver
{
    protected $dir = 'posts';
    public function __construct(StoreOrUpload $imageHandler)
    {
        $this->imageHandler = $imageHandler;
    }

    public function creating(Post $post)
    {
        if (request()->image !== null) {
            $this->imageHandler->addOrUpdate($post, $this->dir);
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
            $this->imageHandler->addOrUpdate($post, $this->dir);
        }
        $post->author_id = auth()->user()->id;
    }
}
