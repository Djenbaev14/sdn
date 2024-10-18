<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable =['item_id'];

    public function item():BelongsTo{
        return $this->belongsTo(Item::class);
    }
    public function menu_item():HasMany{
        return $this->HasMany(Menu_item::class);
    }
    public function children():HasMany{
        return $this->HasMany(Children::class);
    }
}
