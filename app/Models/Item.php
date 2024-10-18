<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $guraded=['id'];

    public function menu():HasMany{
        return $this->hasMany(Menu::class);
    }
    public function children():HasMany{
        return $this->hasMany(Children::class);
    }
    public function menu_item():HasMany{
        return $this->HasMany(Menu_item::class);
    }
    
}
