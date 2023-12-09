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
                        if($recipe['crafttable_id'] == 1)
                        {
                            $recipes += array(5 => '/img/attention.png');
                            $craft_num = $recipe['crafttable_id'];
                            $item_num = $recipe['item_num'];
                        } 
                        elseif ($recipe['crafttable_id'] == 2)
                        {
                            $recipes += array(1 => $item_object->finditem($recipe['item_id1']));
                            $recipes += array(2 => $item_object->finditem($recipe['item_id2']));
                            $recipes += array(3 => $item_object->finditem($recipe['item_id3']));
                            $recipes += array(4 => $item_object->finditem($recipe['item_id4']));
                            $recipes += array(5 => $item_object->finditem($recipe['item_id5']));
                            $recipes += array(6 => $item_object->finditem($recipe['item_id6']));
                            $recipes += array(7 => $item_object->finditem($recipe['item_id7']));
                            $recipes += array(8 => $item_object->finditem($recipe['item_id8']));
                            $recipes += array(9 => $item_object->finditem($recipe['item_id9']));
                            $craft_num = $recipe['crafttable_id'];
                            $item_num = $recipe['item_num'];
                        } 
                        elseif($recipe['crafttable_id'] == 3)
                        {
                            $recipes += array(1 => $item_object->finditem($recipe['item_id1']));
                            $recipes += array(2 => $item_object->finditem($recipe['item_id2']));
                            $recipes += array(3 => $item_object->finditem($recipe['item_id3']));
                            $craft_num = $recipe['crafttable_id'];
                            $item_num = $recipe['item_num'];
                            break;
                        }
                        elseif($recipe['crafttable_id'] == 4)
                        {
                            $recipes += array(1 => $item_object->finditem($recipe['item_id1']));
                            $recipes += array(2 => $item_object->finditem($recipe['item_id2']));
                            $craft_num = $recipe['crafttable_id'];
                            $item_num = $recipe['item_num'];
                            break;
                        }
                        elseif($recipe['crafttable_id'] == 5)
                        {
                            $recipes += array(1 => $item_object->finditem($recipe['item_id1']));
                            $recipes += array(2 => $item_object->finditem($recipe['item_id2']));
                            $recipes += array(3 => $item_object->finditem($recipe['item_id3']));
                            $craft_num = $recipe['crafttable_id'];
                            $item_num = $recipe['item_num'];
                            break;
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
        }
        return $data;
    } 
}
