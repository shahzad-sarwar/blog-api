<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Post\PostRequest;
use App\Http\Requests\API\Post\PostUpdateRequest;
use App\Http\Resources\API\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:super-admin|manager|user', 'auth:api'])->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['author', 'categories'])->latest()->paginate(10);
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $category = Category::find($request->categories);
        
        $post = auth()->user()->posts()->create(
            $request->only('title', 'body', 'meta_title', 'meta_keywords', 'meta_description', 'slug')
        );

        $post->categories()->attach($category);
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        
        if (!$this->checkRoles($post)) {
            return response()->json(['message' => 'unauthenticated'], 403);
        }

        $post->update(
            $request->only('title', 'body', 'meta_title', 'meta_keywords', 'meta_description', 'slug')
        );

        $category = Category::find($request->categories);
        $post->categories()->sync($category);

        return new PostResource($post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (!$this->checkRoles($post)) {
            return response()->json(['message' => 'unauthenticated'], 403);
        }

        $post->delete();
        return response()->json(null, 200);
    }

     protected function checkRoles($post)
     {
         return auth()->user()->hasAnyRole(['super-admin|manager']) || $post->author_id === auth()->user()->id;
     }
}
