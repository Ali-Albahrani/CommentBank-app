<?php

namespace Database\Seeders;

use App\Models\Comments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comments::truncate();

        $info = fopen(base_path("database/data/commentBank.csv"), "r");
        $dataRow = true;
        while (($data = fgetcsv($info, 4000, ",")) !== FALSE) {
            if (!$dataRow) {
                Comments::create([
                    'type' => $data['0'],
                    'comment_name' => $data['1'],
                    'author' => $data['2'],
                    'email' => $data['3'],
                    'validated' => $data['4'],
                    'effect' => $data['5']
                ]);
            }
            $dataRow = false;
        }

        fclose($info);
    }
}