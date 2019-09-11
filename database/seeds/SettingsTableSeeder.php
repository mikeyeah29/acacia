<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('settings')->truncate();

    	$settings = [];

    	$settings[] = array(
    		'key' => 'Acacia Email',
    		'value' => 'acaciaguitars@gmail.com',
    		'data_type' => 'string'
    	);

        Setting::insert($settings);
    }
}
