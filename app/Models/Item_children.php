<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item_children extends Model
{
    use HasFactory;

    public function children():BelongsTo{
        return $this->BelongsTo(Children::class);
    }
    public function item():BelongsTo{
        return $this->BelongsTo(Item::class);
    }
}
