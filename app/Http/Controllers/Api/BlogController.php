<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use Intervention\Image\Facades\Image;

class BlogController extends Controller {

    public function index() {
        $data_blogs = Blog::latest()->get();
        return response()->json([
                    'success' => true,
                    'message' => 'List Data Blogs',
                    'data' => $data_blogs
                        ], 200);
    }

    public function store(Request $request) {
//        dd($request->all());
        //set validation
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'img_blog' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
//        $image_path = $request->file('img_blog')->storage_path('app/public/images/blogs');
//        $image_path = $request->file('image')->storage_path('image', 'public/images/blogs');
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

//        if ($request->has('img_blog')) {
//            $image = $request->img_blog;
//            $name = (Str::slug($request->title) . '.' . $image->getClientOriginalExtension());
//            $path = storage_path('app/public/images/blogs');
//            $image->move($path, $name);
//        }

//        if ($request->hasFile('img_blog')) {
//            $photo = $request->file('img_blog');
//            $ext = strtolower($photo->getClientOriginalExtension());
//            $image_full_name = Str::slug($request->title) . '.' . $ext;
//            $location = storage_path('app/public/images/blogs') . '/' . $image_full_name;
//            Image::make($photo)->save($location);
//            $this->model->img_blog = $image_full_name;
//        }

        if ($request->hasFile('img_blog')) {
            $photo = $request->file('img_blog');
            $ext = strtolower($photo->getClientOriginalExtension());
            $image_full_name = Str::slug($request->title) . '.' . $ext;
            $location = storage_path('app/public/images/blogs') . '/' . $image_full_name;
            Image::make($photo)->save($location);
            $image['img_blog'] = $image_full_name;
//            $data->save();
        }

        //save to database
        $blog = Blog::create([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'img_blog' => $image_full_name,
                    'description' => $request->description,
                    'status' => $request->status,
        ]);

        //success save to database
        if ($blog) {

            return response()->json([
                        'success' => true,
                        'message' => 'Blog Created',
                        'data' => $blog
                            ], 201);
        }

        //failed save to database
        return response()->json([
                    'success' => false,
                    'message' => 'Blog Failed to Save',
                        ], 409);
    }

    public function show($id) {
        //find post by ID
        $blog = Blog::findOrfail($id);

        //make response JSON
        return response()->json([
                    'success' => true,
                    'message' => 'Detail Data Blog',
                    'data' => $blog
                        ], 200);
    }

    public function update(Request $request, $id) {
        //set validation
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find post by ID
        $blog = Blog::findOrFail($id);

        if ($blog) {

            //update post
            $blog->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'img_blog' => $request->img_blog,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            return response()->json([
                        'success' => true,
                        'message' => 'Blog Updated',
                        'data' => $blog
                            ], 200);
        }

        //data post not found
        return response()->json([
                    'success' => false,
                    'message' => 'Blog Not Found',
                        ], 404);
    }

    public function destroy($id) {
        //find post by ID
        $blog = Blog::findOrfail($id);

        if ($blog) {

            //delete post
            $blog->delete();

            return response()->json([
                        'success' => true,
                        'message' => 'Blog Deleted',
                            ], 200);
        }

        //data post not found
        return response()->json([
                    'success' => false,
                    'message' => 'Blog Not Found',
                        ], 404);
    }

}
