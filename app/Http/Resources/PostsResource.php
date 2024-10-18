<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
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
            'item_id'=>$this->item_id,
            "title_qr"=>$this->title_qr ,
            "title_uz"=>$this->title_uz,
            "title_ru"=>$this->title_ru ,
            "slug"=>$this->slug ,
            "photo"=>$this->photo ,
            "created_at"=>$this->created_at ,
        ];
    }
}
