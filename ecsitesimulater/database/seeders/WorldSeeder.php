<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\World;

class WorldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        World::truncate();
        World::create([
            'name' => 'オーバーワールド',
            'order' => '1'
        ]);
        World::create([
            'name' => 'ネザー',
            'order' => '2'
        ]);
        World::create([
            'name' => 'エンド',
            'order' => '3'
        ]);
    }
}
