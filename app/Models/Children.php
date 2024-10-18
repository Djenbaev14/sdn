<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Children extends Model
{
    use HasFactory;

    protected $fillable =['menu_item_id','item_id','number'];

    public function item():HasMany{
        return $this->HasMany(Item::class);
    }
    public function menu_item():BelongsTo{
        return $this->BelongsTo(Menu_item::class);
    }
}
