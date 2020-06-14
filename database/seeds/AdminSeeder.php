<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@myshop.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'level' => 0,
            'admin_access' => true,
            'phone' => '0123456789',
            'address' => '{"tinh":"Th\u00e0nh ph\u1ed1 H\u00e0 N\u1ed9i","huyen":"Huy\u1ec7n \u0110\u00f4ng Anh","xa":"X\u00e3 Nam H\u1ed3ng"}',
            'remember_token' => str_random(10),
        ]);
    }
}
