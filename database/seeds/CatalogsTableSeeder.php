<?php

use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CatalogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catalogs = factory(Catalog::class)->times(10)->create();

        foreach ($catalogs as $catalog) {
            $products = factory(Product::class)->times(20)->create();

            $syncProduct = $catalog->products()->saveMany($products);
        }
    }
}
