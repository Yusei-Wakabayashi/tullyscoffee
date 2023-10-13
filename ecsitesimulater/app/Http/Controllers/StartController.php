<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class StartController extends Controller
{
    public function index()
    {

        return view('app');
    }

    public function getItems()
    {
        //データベース内のアイテム名
        $object = new Item;
        return $object->getdata();
    }
}
