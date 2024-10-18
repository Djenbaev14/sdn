<?php

namespace App\Http\Resources;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this[0]->id,
            'item'=>new ItemResource(Item::findOrFail($this[0]->item_id)),
            "title_qr"=>$this[0]->title_qr ,
            "title_uz"=>$this[0]->title_uz,
            "title_ru"=>$this[0]->title_ru ,
            "body_qr"=>$this[0]->body_qr ,
            "body_uz"=>$this[0]->body_uz,
            "body_ru"=>$this[0]->body_ru ,
            "slug"=>$this[0]->slug ,
            "photo"=>$this[0]->photo ,
            "created_at"=>$this[0]->created_at ,
        ];
    }
}
