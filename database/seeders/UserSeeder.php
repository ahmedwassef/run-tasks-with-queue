<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $admin = User::FirstOrcreate(['email'=>'admin@admin.com'],[
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456'),

            ]);

    }
}
