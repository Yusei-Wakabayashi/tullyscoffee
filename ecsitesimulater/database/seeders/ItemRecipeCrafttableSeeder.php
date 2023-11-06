<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemRecipeCrafttable;

function empty_null($recode){
    if ($recode == '') {
        return null;
    } else {
        return $recode;
    }
}

class ItemRecipeCrafttableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        ItemRecipeCrafttable::truncate();
        $csv_content = new \SplFileObject(database_path('csv_data'.'/item_recipe_crafttables.csv'));
        $csv_content->setFlags(
            \SplFileObject::READ_CSV |      // CSVとして行を読み込み
            \SplFileObject::READ_AHEAD |    // 先読み／巻き戻しで読み込み
            \SplFileObject::SKIP_EMPTY |    // 空行を読み飛ばす
            \SplFileObject::DROP_NEW_LINE   // 行末の改行を読み飛ばす
        );        
        // 配列に変換
        $csv_data = [];

        foreach($csv_content as $value) {

            // 文字コード変換
            $value = mb_convert_encoding($value, "UTF-8");

            $csv_data[] = [
                'item_id' => (int)$value[0],
                'craft_id1' => $value[1],
                'craft_id2' => $value[2],
                'craft_id3' => $value[3],
                'craft_id4' => $value[4],
                'craft_id5' => $value[5],
                'craft_id6' => $value[6],
                'craft_id7' => $value[7],
                'craft_id8' => $value[8],
                'craft_id9' => $value[9],
                'crafttable_id' => $value[10],
            ];
        }
    
        foreach($csv_data as $data){
            if($data['item_id'] == 0){
                $data['item_id'] = 1;
            }
            ItemRecipeCrafttable::create([
                'item_id' => $data['item_id'],
                'item_id1' => empty_null($data['craft_id1']),
                'item_id2' => empty_null($data['craft_id2']),
                'item_id3' => empty_null($data['craft_id3']),
                'item_id4' => empty_null($data['craft_id4']),
                'item_id5' => empty_null($data['craft_id5']),
                'item_id6' => empty_null($data['craft_id6']),
                'item_id7' => empty_null($data['craft_id7']),
                'item_id8' => empty_null($data['craft_id8']),
                'item_id9' => empty_null($data['craft_id9']),
                'crafttable_id' => $data['crafttable_id'],
            ]);
        }
    }
}
