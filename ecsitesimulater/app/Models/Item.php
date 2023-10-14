<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';

    public function getData()
    {
        $data = DB::table($this->table)->get();
        return $data;
    }
    public function finditem($id)
    {
        return Item::find($id);
    }
    public function search_name($name)
    {
        $items = Item::where('name', 'like', "%$name%")->get();
        return $items;
    }
}
