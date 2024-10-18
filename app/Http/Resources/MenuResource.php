<?php

namespace App\Http\Resources;

use App\Models\Menu_item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            "name_qr"=>$this->item->name_qr ,
            "name_uz"=>$this->item->name_uz,
            "name_ru"=>$this->item->name_ru ,
            "slug"=>$this->item->slug ,
            'menu_items'=>MenuItemResource::collection(Menu_item::where('menu_id',$this->id)->get()),
        ];
    }
}
