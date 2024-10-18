<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BlogResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this[0]->id,
            'item_id'=>$this[0]->item_id,
            "title_qr"=>$this[0]->title_qr ,
            "title_uz"=>$this[0]->title_uz,
            "title_ru"=>$this[0]->title_ru ,
            "body_qr"=>$this[0]->body_qr ,
            "body_uz"=>$this[0]->body_uz,
            "body_ru"=>$this[0]->body_ru ,
            "created_at"=>$this[0]->created_at ,
        ];
    }
}
