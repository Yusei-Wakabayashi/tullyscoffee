<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

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
                'note' => $value[3],
                'order' => $value[4],
                'howtoget' => $value[5],
            ];
        }
        foreach($csv_data as $data){
            if ($data['pic'] != "\u{FEFF}pic"){
                Item::create([
                    'pic' => $data['pic'],
                    'name' => $data['name'],
                    'note' => $data['note'],
                    'order' => $data['order'],
                    'howtoget' => $data['howtoget'],
                ]);
                
            }
        }
    }
}
