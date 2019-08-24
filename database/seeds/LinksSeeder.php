<?php

use App\Model\Links;
use Illuminate\Database\Seeder;

class LinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
          'links_name' => 'Laravel-China中文社区',
          'links_url' => 'https://learnku.com/laravel',
          'links_order' => '1',
        ];

        Links::create($data);
    }
}
