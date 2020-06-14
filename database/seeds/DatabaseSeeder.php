<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(SlidesTableSeeder::class);
        $this->call(CatalogsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
