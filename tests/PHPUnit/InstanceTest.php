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

    public function testSimpleInstance ()
    {

       $config = \Hive\Config\Instance::MockSimple();

       $this->assertArrayHasKey('class', $config);
       $this->assertArrayHasKey('static', $config);
       $this->assertArrayHasKey('simple', $config);

       $this->assertEquals('MockSimple', $config['class']);
       $this->assertEquals('default', $config['static']);
       $this->assertEquals('true', $config['simple']);
    }

    public function testInheritInstance ()
    {

        $config = \Hive\Config\Instance::MockInherit();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);
        $this->assertArrayHasKey('inherit', $config);

        $this->assertEquals('MockInherit', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);
        $this->assertEquals('true', $config['inherit']);

    }


    public function testConfigNamespaceInstance ()
    {
        $config = new \hive\Config\Instance();
        $config::$namespaces = [
            '',
            '\\Config'
        ];

        $config = $config::MockNamespace();


        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);
        $this->assertArrayHasKey('namespace', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);
        $this->assertEquals('Config', $config['namespace']);


    }

    public function testSharedConfigNamespaceInstance ()
    {

        $config = new \hive\Config\Instance();
        $config::$namespaces = [
            '',
            '\\Shared\\Config'
        ];

        $config = $config::MockNamespace();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);
        $this->assertArrayHasKey('namespace', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);
        $this->assertEquals('Shared\Config', $config['namespace']);

    }



    public function testDualConfigNamespaceInstance ()
    {

        $config = new \hive\Config\Instance();
        $config::$namespaces = [
            '',
            '\\Config',
            '\\Shared\\Config'
        ];

        $config = $config::MockNamespace();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);
        $this->assertArrayHasKey('namespace', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);
        $this->assertEquals('Config', $config['namespace']);

    }


    public function testExistingConfig()
    {
        $instance = new \hive\Config\Instance();

        $config = $instance::MockSimple();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);

        $config = $instance::MockSimple();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);


    }


    public function testSimpleArguments()
    {
        $instance = new \hive\Config\Instance();

        $class = $instance::MockSimple('class');

        $this->assertEquals('MockSimple', $class);


    }

    public function testInheritArguments()
    {
        $instance = new \hive\Config\Instance();

        $simple = $instance::MockInherit('simple');

        $this->assertEquals('true', $simple);

    }

    public function testInheritSameArguments()
    {
        $instance = new \hive\Config\Instance();

        $static = $instance::MockInherit('static');

        $this->assertEquals('default', $static);

    }



    public function testInheritChangedArguments()
    {
        $instance = new \hive\Config\Instance();

        $class = $instance::MockInherit('class');

        $this->assertEquals('MockInherit', $class);

    }


    public function testInstanceArgumentsDoesNotExistException()
    {
        $this->setExpectedException('Hive\Config\Exception\InstanceDoesNotExist');

        $instance = new \hive\Config\Instance();

        $class = $instance::BABABABA('class');


    }




    public function testInstanceDoesNotExistException ()
    {
        $this->setExpectedException('Hive\Config\Exception\InstanceDoesNotExist');

        $config = \Hive\Config\Instance::Environment();

    }


    public function tearDown()
    {
        \Hive\Config\Instance::destroy();
    }


}
