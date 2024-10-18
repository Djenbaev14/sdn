<?php

namespace App\Http\Resources;

use App\Models\Children;
use App\Models\Item;
use App\Models\Item_children;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "id"=> $this->id,
            "item_id"=> $this->item->id,
            "number"=>$this->number,
            "name_qr"=>$this->item->name_qr ,
            "name_uz"=>$this->item->name_uz,
            "name_ru"=>$this->item->name_ru ,
            "slug"=>$this->item->slug ,
            "childrens"=>ChildrenResource::collection(Children::where('menu_item_id',$this->id)->get()),
        ];
    }
}
