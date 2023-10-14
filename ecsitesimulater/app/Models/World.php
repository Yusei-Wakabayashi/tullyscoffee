<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class World extends Model
{
    use HasFactory;
    protected $table = 'worlds';

    public function allgetWorld()
    {
        $worlds = DB::table($this->table)->get();
        return $worlds;
    }
}
