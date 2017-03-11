<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aSeeders = array(
        	UsersSeeder::class,
            CategoriesSeeder::class,
    	);

        foreach ($aSeeders as $oValue) {
        	$this->call($oValue);
        }
    }
}
