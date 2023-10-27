<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Crafttable;

class CrafttableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Crafttable::truncate();
        Crafttable::create([
            'name' => 'クラフト不可アイテム',
            'order' => '1'
        ]);
        Crafttable::create([
            'name' => '作業台',
            'order' => '2'
        ]);
        Crafttable::create([
            'name' => '醸造台',
            'order' => '3'
        ]);
        Crafttable::create([
            'name' => 'かまど',
            'order' => '4'
        ]);
        Crafttable::create([
            'name' => '鍛冶台',
            'order' => '5'
        ]);
    }
}
