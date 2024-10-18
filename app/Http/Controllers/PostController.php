<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::orderBy('id','desc')->get();
        return view('admin.pages.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $items=Item::where('is_news','=',1)->get();
        return view('admin.pages.posts.create',compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'item_id'=>'required',
            'title_uz'=>'required',
            'title_ru'=>'required',
            'title_qr'=>'required',
            'image'=>'mimes:jpg,png,jpeg'
        ]);

        if($request->has('image')){
            $file =$request->file('image');
            $filename = $file->getClientOriginalName(); 
            $file->move(public_path('uploads/'), $filename);
        }else{
            $filename = 'qrqurilis.png'; 
        }

        
        $slug = Str::slug($request->title_uz);
        $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
        $slug = $count ? "{$slug}-{$count}" : $slug;

            $post = new Post();
            $post->item_id = $request->item_id;
            $post->title_qr = $request->title_qr;
            $post->body_qr = $request->body_qr;
            $post->title_ru = $request->title_ru;
            $post->body_ru = $request->body_ru;
            $post->title_uz = $request->title_uz;
            $post->body_uz = $request->body_uz;
            $post->slug = $slug;
            $post->photo=$filename;
            $post->save();

        alert()->success('Пост успешно создан');
        
        return redirect()->route('dashboard.post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
