<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Menu_item;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
     public function index(){
        $items=Item::orderBy('created_at','desc')->get();
        $menus=Menu::orderBy('created_at','desc')->get();
        return view('admin.pages.menus.index',compact('items','menus'));
    }

    public function item_add(Request $request){
        // return $request->all();
        $request->validate([
            'items'=>'array'
        ]);
        
        if($request->items){
            $menus=json_decode(json_encode(Menu::pluck('id')),true);
            // imenu ga itemi bar menulardi qosildi
            $imenu=[];
            foreach($request->items as $menu => $item){
                array_push($imenu,$menu);
            }
            // bazada bar requestte joq bolgan menular bazadan oshirildi
            for ($i=0; $i < count($menus); $i++) { 
                if(!in_array($menus[$i],$imenu)){
                    Menu_item::where('menu_id',$menus[$i])->delete();
                }
            }
            
            foreach ($request->items as $menu=> $item) {

                if(in_array($menu,$menus)){
                    
                    $a=json_decode(json_encode(Menu_item::where('menu_id',$menu)->pluck('item_id')),true);
                    $b=$item;
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
                                Menu_item::where('menu_id',$menu)->where('item_id',$a[$i])->delete();
                    
                        }
                    }else{
                        Menu_item::where('menu_id',$menu)->delete();
                    }
                    // return count($item);
                    for ($i=0; $i < count($item); $i++) {
                        if($item[$i] != Menu::find(id: $menu)->item_id){
                            if(!Menu_item::where('menu_id', $menu)->where('item_id',$item[$i])->exists()){
                                    Menu_item::create([
                                        'menu_id'=>$menu,
                                        'item_id'=>$item[$i],
                                        'number'=>$request->number[$menu][$item[$i]]
                                    ]);
                            } else{
                                Menu_item::where('menu_id', $menu)->where('item_id',$item[$i])->update([
                                    'number'=>$request->number[$menu][$item[$i]]
                                ]);
                            }
                        }
    
                    }
                }
            }
        }
        else{
            Menu_item::whereNotNull('id')->delete();
            toast('Меню','success');
            return redirect()->route('dashboard.menu.index');
        }
        toast('Меню успешно создано!','success');
        return redirect()->route('dashboard.menu.index');
    }
    public function create(){
        $menus=Menu::orderBy( 'created_at', 'desc')->get();
        $items=Item::orderBy( 'created_at', 'desc')->get();
        return view('admin.pages.menus.create',compact('menus','items'));
    }

    public function store(Request $request){
        $request->validate([
            'items'=>'array'
        ]);
        for ($i=0; $i < count($request->items); $i++) { 
            Menu::create([
                'item_id'=>$request->items[$i],
                'number'=>"1"
            ]);
        }
        toast('Меню успешно создан','success');
        return redirect()->route('dashboard.menu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
