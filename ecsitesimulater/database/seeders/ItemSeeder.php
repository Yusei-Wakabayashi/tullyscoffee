<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

function empty_null($recode){
    if ($recode==''){
        return $recode = null;
    }
    else {
        return $recode;
    }
}

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::truncate();
        $csv_content = new \SplFileObject(database_path('csv_data'.'/recipe_book.csv'));
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
            // 項目行を省く        
            if($value[0] == "pic"){
                continue;
            }
            $csv_data[] = [
                'pic' => $value[0],
                'name' => $value[1],
                'id' => $value[2],
                'craft_name_id1' => $value[3],
                'craft_name_id2' => $value[4],
                'craft_name_id3' => $value[5],
                'craft_name_id4' => $value[6],
                'craft_name_id5' => $value[7],
                'craft_name_id6' => $value[8],
                'craft_name_id7' => $value[9],
                'craft_name_id8' => $value[10],
                'craft_name_id9' => $value[11],
                'item_id1' => $value[12],
                'item_id2' => $value[13],
                'item_id3' => $value[14],
                'item_id4' => $value[15],
                'item_id5' => $value[16],
                'item_id6' => $value[17],
                'item_id7' => $value[18],
                'item_id8' => $value[19],
                'item_id9' => $value[20],
                'note' => $value[21],
                'order' => $value[22],
                'crafttable_id' => $value[23],
            ];
        }
        foreach($csv_data as $data){
            if ($data['pic'] != "\u{FEFF}pic"){
                Item::create([
                    'pic' => $data['pic'],
                    'name' => $data['name'],
                    'item_id1' => empty_null($data['item_id1']),
                    'item_id2' => empty_null($data['item_id2']),
                    'item_id3' => empty_null($data['item_id3']),
                    'item_id4' => empty_null($data['item_id4']),
                    'item_id5' => empty_null($data['item_id5']),
                    'item_id6' => empty_null($data['item_id6']),
                    'item_id7' => empty_null($data['item_id7']),
                    'item_id8' => empty_null($data['item_id8']),
                    'item_id9' => empty_null($data['item_id9']),
                    'note' => $data['note'],
                    'order' => $data['order'],
                    'crafttable_id' => empty_null($data['crafttable_id'])
                ]);
                
            }
        }
    }
}
