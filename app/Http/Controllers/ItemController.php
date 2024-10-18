<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Blog;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items=Item::orderBy('id','desc')->get();
        return view('admin.pages.items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ru'=>'required',
            'name_qr'=>'required',
            'name_uz'=>'required',
        ]);
        if(!$request->has('is_news')){
            $request->validate([
                'title_ru'=>'required',
                'title_qr'=>'required',
                'title_uz'=>'required',
            ]);
        }
        $item = new Item();
        $item->name_qr = $request->name_qr;
        $item->name_ru = $request->name_ru;
        $item->name_uz = $request->name_uz;
        $item->is_news = $request->has('is_news') ? 1 : 0;
        $item->slug = Str::slug($request->name_uz, '-');
        $item->save();
        if(!$request->has('is_news')){
            $blog= new Blog();
            $blog->item_id = $item->id;
            $blog->title_qr = $request->title_qr;
            $blog->body_qr = $request->body_qr;
            $blog->title_ru = $request->title_ru;
            $blog->body_ru = $request->body_ru;
            $blog->title_uz = $request->title_uz;
            $blog->body_uz = $request->body_uz;
            $blog->save();
        }
        toast('Страницу успешно создан','success');
        
        return redirect()->route('dashboard.items.index')->with('success', 'Успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        // return new ItemResource($item);
        return $item->id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('admin.pages.items.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name_ru'=>'required',
            'name_qr'=>'required',
            'name_uz'=>'required',
        ]);
        if(!$request->has('is_news')){
            $request->validate([
                'title_ru'=>'required',
                'title_qr'=>'required',
                'title_uz'=>'required',
            ]);
        }
        $item->name_qr = $request->name_qr;
        $item->name_ru = $request->name_ru;
        $item->name_uz = $request->name_uz;
        $item->is_news = $request->has('is_news') ? 1 : 0;
        $item->slug = Str::slug($request->name_uz, '-');
        $item->save();
        if(!$request->has('is_news')){
            $blog= Blog::where('item_id',$item->id)->first();
            $blog->item_id = $item->id;
            $blog->title_qr = $request->title_qr;
            $blog->body_qr = $request->body_qr;
            $blog->title_ru = $request->title_ru;
            $blog->body_ru = $request->body_ru;
            $blog->title_uz = $request->title_uz;
            $blog->body_uz = $request->body_uz;
            $blog->save();
        }
        toast('Страницу успешно создан','success');
        
        return redirect()->route('dashboard.items.index')->with('success', 'Успешно создан');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
    
        return redirect()->route('dashboard.items.index')
                        ->with('success','Успешно удален');
    }
}
