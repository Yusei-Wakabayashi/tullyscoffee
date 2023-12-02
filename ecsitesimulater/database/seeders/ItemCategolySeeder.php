<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ItemCategoly;

class ItemCategolySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemCategoly::truncate();
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

            $csv_data[] = [
                'item_id' => (int)$value[0],
                'categoly_id' => (int)$value[1]
            ];
        }
        foreach($csv_data as $data){
            ItemCategoly::create([
                'item_id' => $data['item_id'],
                'categoly_id' => $data['categoly_id']
            ]);
        }
    }
}
