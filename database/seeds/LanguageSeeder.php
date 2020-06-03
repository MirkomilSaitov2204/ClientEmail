<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::insert([
    		[
    			'flag'          => '',
    			'name'          => 'uz',
    			'iso_code'      => 'uz',
    			'language_code' => 'uz',
    			'date_format'   => 'Y-m-d H:i:s',
    			'is_active'     => 1,
    		],
    		[
    			'flag'          => '',
    			'name'          => 'ru',
    			'iso_code'      => 'ru',
    			'language_code' => 'ru',
    			'date_format'   => 'Y-m-d H:i:s',
    			'is_active'     => 1,
    		],
    		[
    			'flag'          => '',
    			'name'          => 'en',
    			'iso_code'      => 'en',
    			'language_code' => 'en',
    			'date_format'   => 'Y-m-d H:i:s',
    			'is_active'     => 1,
    		]
    	]);
    }
}
