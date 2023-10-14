<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Categoly;
use App\Models\ItemCategoly;
use App\Models\World;
use App\Models\ItemWorld;
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
    }
    public function findItemid()
    {
        $id = 1;//引数として入ってきたものを入れる
        $object = new Item;
        return $object->finditem($id);
        //返すのは一つのアイテムのデータのみ
    }
    public function searchItems()
    {
        $name = '樹皮を剥いだサクラの木';//引数として入ってきたものを入れる
        $object = new Item;
        return $object->search_name($name);
    }
    public function allCategoly()
    {
        $object = new Categoly;
        return $object->allgetCategoly();
    }
    public function allWorld()
    {
        $object = new World;
        return $object->allgetWorld();
    }
    public function selectCategoly()
    {
        $categoly_id = 1;
        $data = [];
        $object = new ItemCategoly;
        //$item_object = new Item;
        //$items = $object->search_item($categoly_id);
        $items = $object->search_item($categoly_id);
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
        $data = $items->map( function($i) {
            $item_object = new Item;
            return $item_object->finditem($i->item_id);
            //var_dump($data);
        });
        return $data;
    }
    public function selectWorld()
    {
        $world_id = 1;
        $data = [];
        $object = new ItemWorld;
        $items = $object->search_item($world_id);
        $data = $items->map( function($i) {
            $item_object = new Item;
            return $item_object->finditem($i->item_id);
        });
        return $data;
    }
}
