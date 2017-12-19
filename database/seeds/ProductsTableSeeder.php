<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('products')->truncate();

        for ($i=0; $i<50; $i++) {
            Product::create(
                [
                    'name'               => 'Product ' . $i,
                    'description'        => 'Description lala ' . $i,
                    'price' => rand(10000, 99999),
                ]
            );
        }
    }
}