<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class PostController extends Controller {

    public function index() {
        return new PostResource(Post::all());
    }

    public function store(Request $request) {
        //set validation
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'content' => 'required',
                    'img_post' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'status' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->hasFile('img_post')) {
            $photo = $request->file('img_post');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Str::slug($request->title) . '.' . $ext;
            $location = storage_path('app/public/images/posts') . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $image['img_post'] = $image_full_name;
        }

        //save to database
        $post = Post::create([
                    'title' => $request->title,
                    'content' => $request->content,
                    'slug' => Str::slug($request->title),
                    'img_post' => $image_full_name,
                    'status' => $request->status,
                    'deleted_at' => Carbon::now()->addDays(14),
        ]);

        return new PostResource($post);
    }

    public function show(Post $post) {
        return new PostResource($post);
    }

    public function update(Request $request, Post $post) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'content' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //update to database
        $post->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return new PostResource($post);
    }

    public function destroy(Post $post) {
        $post->delete();
        return new PostResource($post);
    }

}
