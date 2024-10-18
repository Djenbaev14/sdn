<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Menu_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items=Item::orderBy('created_at','desc')->get();
        $menu_items=Menu_item::orderBy('created_at','desc')->get();
        $childrens=Children::orderBy('created_at','desc')->get();
        $menus=Menu::orderBy('created_at','desc')->get();
        return view('admin.pages.childrens.index',compact('menu_items','items','childrens','menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'childrens'=>'array'
        ]);
            if($request->childrens){
                $menu_items=json_decode(json_encode(Menu_item::pluck('id')),true);
                // imenu ga itemi bar menulardi qosildi
                $imenu_item=[];
                foreach($request->childrens as $menu_item => $children){
                    array_push($imenu_item,$menu_item);
                }
                // bazada bar requestte joq bolgan menular bazadan oshirildi
                for ($i=0; $i < count($menu_items); $i++) { 
                    if(!in_array($menu_items[$i],$imenu_item)){
                        Children::where('menu_item_id',$menu_items[$i])->delete();
                    }
                }
                
                foreach ($request->childrens as $menu_item=> $children) {
    
                    if(in_array($menu_item,$menu_items)){
                        
                        $a=json_decode(json_encode(Children::where('menu_item_id',$menu_item)->pluck('item_id')),true);
                        $b=$children;
                        $n = count($a);
                        $m = count($b);
                        if($m >0){
                            for ( $i = 0; $i < $n; $i++)
                            {
                                $j;
                                for ($j = 0; $j < $m; $j++)
                                    if ($a[$i] == $b[$j])
                                        break;
        
                                if ($j == $m)
                                Children::where('menu_item_id',$menu_item)->where('item_id',$a[$i])->delete();
                        
                            }
                        }else{
                            Children::where('menu_item_id',$menu_item)->delete();
                        }
                        for ($i=0; $i < count($children); $i++) {   
                                if(!Children::where('menu_item_id', $menu_item)->where('item_id',$children[$i])->exists()){
                                    Children::create([
                                            'menu_item_id'=>$menu_item,
                                            'item_id'=>$children[$i],
                                        ]);
                                } 
        
                        }
                    }else{
                        return $children;
                    }
                }
            }
            else{
                Children::whereNotNull('id')->delete();
                toast('Итем','success');
                return redirect()->route('dashboard.children.index');
            }
        toast('Итем успешно создано!','success');
        return redirect()->route('dashboard.children.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Children $children)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Children $children)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Children $children)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Children $children)
    {
        //
    }
}
