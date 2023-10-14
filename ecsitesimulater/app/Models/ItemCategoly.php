<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategoly extends Model
{
    use HasFactory;
    protected $table = 'item_categolies';
    public function search_item($categoly_id)
    {
        $items = ItemCategoly::where('categoly_id', '=', $categoly_id)->get();
        return $items;
    }
}
