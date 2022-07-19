<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\PostValidationTrait;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponseTrait;
    use PostValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostResource::collection(Post::all());
        return $this->apiResponse($posts, 'OK', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->validateRequest($request)['status'])
            return $this->apiResponse(null, $this->validateRequest($request)['message'], 400);
        $post = Post::create($request->all());
        if($post)
            return $this->apiResponse(new PostResource($post), 'Post created', 201);
        return $this->apiResponse(null, 'Post Not created', 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post)
            return $this->apiResponse(new PostResource($post), 'OK', 200);
        return $this->apiResponse(null, 'Post Not found', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$this->validateRequest($request)['status'])
            return $this->apiResponse(null, $this->validateRequest($request)['message'], 400);
        $post = Post::find($id);
        if(!$post)
            return $this->apiResponse(null, 'Post Not found', 404);
        $post->update($request->all());
        if($post)
            return $this->apiResponse(new PostResource($post), 'Post updated', 201);
        return $this->apiResponse(null, 'Post Not updated', 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(!$post)
            return $this->apiResponse(null, 'Post Not found', 404);
        $post->delete();
        if($post)
            return $this->apiResponse(null, 'Post deleted', 200);
    }
}
