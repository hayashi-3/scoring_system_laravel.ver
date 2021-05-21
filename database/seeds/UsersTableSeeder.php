<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 2)->create();

        DB::table('users')->insert([
            'name' => '管理テスト',
            'password' => Hash::make('password'),
            'admin_flag' => 1,
        ]);
    }
}
