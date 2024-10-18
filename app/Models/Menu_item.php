<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu_item extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function menu():BelongsTo{
        return $this->BelongsTo(Menu::class);
    }
    public function item():BelongsTo{
        return $this->BelongsTo(Item::class);
    }
    public function children():HasMany{
        return $this->HasMany(Children::class);
    }
}
