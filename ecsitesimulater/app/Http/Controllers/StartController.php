<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Categoly;
use App\Models\ItemCategoly;
use App\Models\World;
use App\Models\ItemWorld;
use App\Models\ItemRecipeCrafttable;
use Illuminate\Support\Facades\DB;

class StartController extends Controller
{
    public function index()
    {
        return view('app');
    }
    public function getItems()
    {
        $object = new Item;
        return $object->getData();
        //全てのアイテムを配列として返します
    }
    public function findItemid($id)
    {
        //$id = 1;//引数として入ってきたものを入れる
        $object = new Item;
        return $object->finditem($id);
        //引数として一つのアイテムのidを渡してそのアイテムのデータを返す
    }
    public function searchItems($name)
    {
        //$name = '樹皮を剥いだサクラの木';//引数として入ってきたものを入れる
        $object = new Item;
        return $object->search_name($name);
        //引数として入力された文言をでitemテーブルに検索をかけて合致するものがあれば配列として返します
    }
    public function categolylist()
    {
        $object = new Categoly;
        return $object->allgetCategoly();
        //全てのカテゴリーを配列として返します(id含む)
    }
    public function worldlist()
    {
        $object = new World;
        return $object->allgetWorld();
        //全てのワールドを配列として返します(id含む)
    }
    public function selectCategoly($id)
    {
        //$request = 1;
        $data = [];
        $ItemCategoly_object = new ItemCategoly;
        $Item_object = new Item;
        //$item_object = new Item;
        //$items = $object->search_item($categoly_id);
         //dd($items);
//         foreach ($items as $item);
//         {
//           //  dd($item);
// echo $item->item_id;
// echo "<br>";
//           //  $data[] = $item_object->finditem($item->item_id);
//         }
        //$testdatas = [
        //    'cookie',
        //    'chocolate',
        //    'gam'
        //];
        //$test = [];
        //foreach ($testdatas as $testdata)
        //{
        //    //dd($testdata);
        //    array_push($test,$testdata);
        //}
        //dd($test);
        if ($id == 10)
        {
            return $Item_object->getData();
        }
        else
        {
            $items = $ItemCategoly_object->search_item($id);
            $data = $items->map( function($i) {
                $item_object = new Item;
                return $item_object->finditem($i->item_id);
                //var_dump($data);
            });
            return $data;
        }
        //入ってきたカテゴリーidに合致するアイテムを配列として返します
    }
    public function selectWorld($id)
    {
        //$request = 1;
        $data = [];
        $Item_object = new Item;
        $ItemWorld_object = new ItemWorld;
        if ($id == 4)
        {
            return $Item_object->getData();
        }
        else
        {
            $items = $ItemWorld_object->search_item($id);
            $data = $items->map( function($i) {
                $item_object = new Item;
                return $item_object->finditem($i->item_id);
            });
            return $data;
        }
        
        //入ってきたワールドidに合致するアイテムを配列として返します
    }
    public function search_recipe($id)
    {
        $ItemRecipeCrafttable_object = new ItemRecipeCrafttable;
        return $ItemRecipeCrafttable_object->search_recipe($id);
    }
    public function catwar($world_id,$categoly_id)
    {
        if ($world_id == 4){
            if ($categoly_id == 10){
                return StartController::getItems();
            }
            else{
                return StartController::selectCategoly($categoly_id);
            }
        }
        elseif ($categoly_id == 10){
            return StartController::selectWorld($world_id);
        }
        
        $categoly = DB::table('item_categolies')
        ->where('categoly_id', '=', ':cat_id')
        ->toSql();
        //dd($categoly);
        $items = DB::table(DB::raw('('.$categoly.') AS cat'))
        ->leftJoin('item_worlds', 'item_worlds.item_id', '=', 'cat.item_id')
        ->setBindings([':cat_id'=>$categoly_id])
        ->where('item_worlds.world_id', '=', $world_id)
        ->get();
        return $items;
    }
}
