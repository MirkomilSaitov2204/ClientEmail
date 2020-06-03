<?php


use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        for ($i=1; $i <= 100 ; $i++) {
            Product::insert([
                [
                    'product'       => json_encode([ "uz"=>"Noutbook-".$i, "ru"=>"Ноутбук".$i,"en"=>"Laptop".$i]),
                    'cost'          => 50000+$i,
                    'is_active'  => 1,
                    'iso_code'   => 'uz',
                    'created_at' => $now,
                    'updated_at' => $now
                ]
            ]);
        }
    }
}
