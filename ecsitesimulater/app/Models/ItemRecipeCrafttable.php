<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRecipeCrafttable extends Model
{
    use HasFactory;
    protected $table = 'item_recipe_crafttables';
    public function search_recipe($item_id)
    {
        $recipes = ItemRecipeCrafttable::where('item_id', '=', $item_id)->get();
        return $recipes;
    }
}
