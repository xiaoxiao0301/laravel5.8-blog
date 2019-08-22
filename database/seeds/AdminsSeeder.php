<?php

use Illuminate\Database\Seeder;
use App\Model\Admins;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
          'username' => 'demon',
          'password' => Hash::make('123456')
        ];

        Admins::create($data);
    }
}
