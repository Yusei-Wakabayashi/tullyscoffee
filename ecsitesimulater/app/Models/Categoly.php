<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoly extends Model
{
    use HasFactory;
    protected $table = 'categolies';

    public function allgetCategoly()
    {
        $categolies = DB::table($this->table)->get();
        return $categolies;
    }
}
