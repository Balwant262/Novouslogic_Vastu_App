<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@admin.com',
               'is_admin'=>'1',
               'password'=> bcrypt('123456'),
               'contact_number'=>'9876543210',
            ],
            [
               'name'=>'User',
               'email'=>'user@taxivaxi.com',
               'is_admin'=>'0',
               'password'=> bcrypt('123456'),
               'contact_number'=>'9876543219',
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
