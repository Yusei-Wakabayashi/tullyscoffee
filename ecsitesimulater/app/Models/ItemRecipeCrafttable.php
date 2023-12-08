<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class ItemRecipeCrafttable extends Model
{
    use HasFactory;
    protected $table = 'item_recipe_crafttables';
    public function search_recipe($item_id)
    {
        $data = [];
        $recipes = [];
        $items = [];

        $nums = 1;
        $craft_num = null;
        $item_num = null;

        $item_object = new Item;
        $item_id = ItemRecipeCrafttable::where('item_id', '=', $item_id)
        ->get(['item_id1','item_id2','item_id3','item_id4','item_id5','item_id6','item_id7','item_id8','item_id9','crafttable_id','item_num']);
        foreach($item_id as $recipe_id)
        {
            foreach($recipe_id as $key => $recipe)
            {
                if ($key == 'attributes')
                {
                    foreach($recipe as $value => $id)
                    {
                        if (!($value == 'crafttable_id') and !($value == 'item_num'))
                        {
                            $recipes += array($nums => $item_object->finditem($id));
                            $nums += 1;
                        } 
                        elseif($value == 'crafttable_id')
                        {
                            $craft_num = $id;
                        } else
                        {
                            $item_num = $id;
                        }
                    }
                }
            }
            $items += array('recipes' => $recipes);
            $items += array('craft_num' => $craft_num);
            $items += array('item_num' => $item_num);
            $data[] = $items;
// 使った配列や変数を空にしています
            $recipes = array();
            $items = array();

            $craft_num = null;
            $item_num = null;
            $nums = 1;
        }
        return $data;
    } 
}
