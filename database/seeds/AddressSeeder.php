<?php

use App\Models\Tinh;
use App\Models\Huyen;
use App\Models\Xa;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tinh::create([
            'matp' => 1,
            'name' => 'Thành phố Hà Nội',
            'type' => 'Thành phố',
        ]);

        Huyen::create([
            'maqh' => 1,
            'name' => 'Cầu Giấy',
            'type' => 'Quận',
            'matp' => 1,
        ]);

        Huyen::create([
            'maqh' => 2,
            'name' => 'Đông Anh',
            'type' => 'Huyện',
            'matp' => 1,
        ]);

        Xa::create([
            'xaid' => 1,
            'name' => 'Phường Dịch Vọng',
            'maqh' => 1,
            'type' => 'Phường',
        ]);

        Xa::create([
            'xaid' => 2,
            'name' => 'Xã Nam Hồng',
            'maqh' => 2,
            'type' => 'Xã',
        ]);
    }
}
