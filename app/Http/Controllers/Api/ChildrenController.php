<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use App\Models\Blog;
use App\Models\Children;
use App\Models\Item;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildrenController extends Controller
{
    public function index(){
        $childrens= Children::all();
        return ItemResource::collection($childrens);
        
    }

    public function blog(Request $request, $slug){
        // return Item::where('slug',$slug)->first()->is_news;
        if(Item::where('slug',$slug)->first()->is_news==1){
            // return Post::orderBy('id','desc')->get();
            return PostsResource::collection(Post::orderBy('id','desc')->paginate(10));
        }
        else if(Item::where('slug',$slug)->first()->is_news==0){
            $item=Item::where('slug',$slug)->first();
            return new BlogResource(Blog::where('item_id',$item->id)->get());
        }
    }

    public function show_post($item_slug,$post_slug){
        $item_id=Item::where('slug',$item_slug)->first()->id;
        return new PostResource(Post::where('item_id',$item_id)->where('slug',$post_slug)->get());
    }
}
