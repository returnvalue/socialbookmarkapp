<?php

use Phpleaks\Category;

class CategoryTest extends TestCase
{

    public function testCanInstantiateCategory()
    {

        $category = new Category;

        $this->assertEquals(get_class($category), 'Phpleaks\Category');

    }

    public function testNotValidWhenNameMissing()
    {

        $category = new Category;

        $this->assertFalse($category->validate());

    }

}

?>