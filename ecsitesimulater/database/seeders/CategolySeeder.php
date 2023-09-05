<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoly;

class CategolySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoly::truncate();
        Categoly::create([
            'name' => '建築',
            'order' => '1'
        ]);
        Categoly::create([
            'name' => '色付きブロック',
            'order' => '2'
        ]);
        Categoly::create([
            'name' => '天然ブロック',
            'order' => '3'
        ]);
        Categoly::create([
            'name' => '機能的ブロック',
            'order' => '4'
        ]);
        Categoly::create([
            'name' => 'レッドストーン系ブロック',
            'order' => '5'
        ]);
        Categoly::create([
            'name' => '道具と実用',
            'order' => '6'
        ]);
        Categoly::create([
            'name' => '戦闘',
            'order' => '7'
        ]);
        Categoly::create([
            'name' => '食べ物と実用',
            'order' => '8'
        ]);
        Categoly::create([
            'name' => '材料',
            'order' => '9'
        ]);
    }
}
