<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemWorld extends Model
{
    use HasFactory;
    protected $table = 'item_worlds';
    public function search_item($world_id)
    {
        $items = ItemWorld::where('world_id', '=', $world_id)->get();
        return $items;
    }
}
