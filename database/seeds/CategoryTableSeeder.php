<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Phpleaks\Category;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        Category::create([
            'name' => 'PHP'
        ]);

        Category::create([
            'name' => 'JavaScript'
        ]);

        Category::create([
            'name' => 'Tutorials'
        ]);
        Category::create([
            'name' => 'Design'
        ]);
        Category::create([
            'name' => 'Devops'
        ]);
        Category::create([
            'name' => 'Programming'
        ]);
        Category::create([
            'name' => 'Linux'
        ]);
        Category::create([
            'name' => 'Search'
        ]);
    }

}