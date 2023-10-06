<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemWorld;

class ItemWorldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemWorld::truncate();
        $csv_content = new \SplFileObject(database_path('csv_data'.'/item_categoly.csv'));
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
            if($value[0] == "id"){
                continue;
            }
            $csv_data[] = [
                'id' => $value[0],
                'item_id' => $value[1],
                'world_id' => $value[2]
            ];
        }
        foreach($csv_data as $data){
            if ($data['id'] != "\u{FEFF}id"){
                ItemWorld::create([
                    'item_id' => $data['item_id'],
                    'world_id' => $data['world_id']
                ]);
                
            }
        }
    }
}
