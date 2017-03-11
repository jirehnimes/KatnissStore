<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('categories')->delete();

        Category::create(array('name' => 'Clothes'));
        Category::create(array('name' => 'Bags'));
        Category::create(array('name' => 'Shoes'));
        Category::create(array('name' => 'Technology'));

    	Model::reguard();
    }
}
