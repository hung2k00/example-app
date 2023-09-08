<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         $data = [
            [
                'name' => 'Trần Mạnh Hùng',
                'gender' => 'Nam',
                'birth_date' => '2000-01-20',
                'address' => 'Nam Định',
                'email' => 'manhhungtran2k@gmail.com',
                'password' => bcrypt('abcd1234'),
            ],
        ];
        DB::table('loyal_customers')->insert($data);
    }
}
