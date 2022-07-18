<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Resources\PostResource;
use App\Models\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponseTrait;
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
        $validation = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        if ($validation->fails())
            return $this->apiResponse(null, $validation->errors(), 400);

        $post = Post::create($request->all());
        if($post)
            return $this->apiResponse(new PostResource($post), 'OK', 201);

        return $this->apiResponse(null, 'Post Not found', 400);
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
        if($post){
            return $this->apiResponse(new PostResource($post), 'OK', 200);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
