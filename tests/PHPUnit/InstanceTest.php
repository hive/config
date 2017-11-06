<?php

/**
* Class testInstance
 *
 * Test the instance setup
*/
class testInstance extends base
{

    /**
     * Sanity check against php unit.
     */
    public function testSanity ()
    {
        $this->assertEquals(1 + 1, 2);
    }

    public function testSimple()
    {
        $config = new \MockSimple();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);

    }

    public function testInherit()
    {
        $config = new \MockInherit();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);
        $this->assertArrayHasKey('inherit', $config);

        $this->assertEquals('MockInherit', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);
        $this->assertEquals('true', $config['inherit']);

    }

    public function testGlobalNamespaceInstance ()
    {

       $config = \Hive\Config\Instance::MockTest();

       $this->assertArrayHasKey('class', $config);
       $this->assertArrayHasKey('static', $config);
       $this->assertArrayHasKey('simple', $config);

       $this->assertEquals('MockSimple', $config['class']);
       $this->assertEquals('default', $config['static']);
       $this->assertEquals('true', $config['simple']);
    }

    public function testConfigNamespaceInstance ()
    {

        //$config = \Hive\Config\Instance::MockTest();
        $this->assertTrue(false);
    }

    public function testSharedConfigNamespaceInstance ()
    {

        //$config = \Hive\Config\Instance::MockTest();
        $this->assertTrue(false);
    }



    public function testInstanceDoesNotExistException ()
    {
        $this->setExpectedException('Hive\Config\Exception\InstanceDoesNotExist');

        $config = \Hive\Config\Instance::Environment();

    }





}
