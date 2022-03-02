<?php

use Phpleaks\Link;

class LinkTest extends TestCase
{

    public function testCanInstantiateLink()
    {

        $link = new Link;

        $this->assertEquals(get_class($link), 'Phpleaks\Link');

    }

    public function testNotValidWhenNameMissing()
    {

        $link = new Link;

        $this->assertFalse($link->validate());

    }

}

?>