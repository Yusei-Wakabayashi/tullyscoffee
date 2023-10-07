<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class StartController extends Controller
{
    public function index()
    {
        $object = new Item;
        $data = $object->getdata();
        return view('testshowitem', ['data' => $data]);
    }
}
