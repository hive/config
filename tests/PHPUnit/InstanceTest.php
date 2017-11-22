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



        \Hive\Config\Instance::config(['namespaces' => ['','\\Config']]);
        $config = \Hive\Config\Instance::MockNamespace();

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

        \Hive\Config\Instance::config(['namespaces' => ['','\\Shared\\Config']]);

        $config = \Hive\Config\Instance::MockNamespace();

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

        \Hive\Config\Instance::config(['namespaces' => ['', '\\Config', '\\Shared\\Config']]);
        $config = \Hive\Config\Instance::MockNamespace();

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

        $config = \Hive\Config\Instance::MockSimple();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);

        $config = \Hive\Config\Instance::MockSimple();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);


    }


    public function testSimpleArguments()
    {

        $class = \Hive\Config\Instance::MockSimple('class');

        $this->assertEquals('MockSimple', $class);


    }

    public function testInheritArguments()
    {
        $simple = \Hive\Config\Instance::MockInherit('simple');

        $this->assertEquals('true', $simple);

    }

    public function testInheritSameArguments()
    {
        $static = \Hive\Config\Instance::MockInherit('static');

        $this->assertEquals('default', $static);

    }



    public function testInheritChangedArguments()
    {

        $class = \Hive\Config\Instance::MockInherit('class');

        $this->assertEquals('MockInherit', $class);

    }


    public function testInstanceArgumentsDoesNotExistException()
    {
        $this->setExpectedException('Hive\Config\Exception\ClassDoesNotExist');

        \Hive\Config\Instance::BABABABA('class');


    }

    /**
     * @expects
     * public static $default = [
     *   'class'     => 'MockNested',
     *   'static'    => 'default',
     *   'simple'    => 'false',
     *   'nest'      => [
     *      'name'  => 'MockNested',
     *      'detail' => [
     *          'type'      => 'nested',
     *          'parent'    => 'none',
     *          'ignore'    => 'true',
     *          'override'  => 'false',
     *      ]
     *   ]
     * ];
     */
    public function testNested()
    {
        $result = \Hive\Config\Instance::MockNested();

        $this->assertArrayHasKey('class', $result);
        $this->assertArrayHasKey('static', $result);
        $this->assertArrayHasKey('simple', $result);
        $this->assertArrayHasKey('nest', $result);
        $this->assertArrayHasKey('name', $result['nest']);
        $this->assertArrayHasKey('detail', $result['nest']);
        $this->assertArrayHasKey('type', $result['nest']['detail']);
        $this->assertArrayHasKey('parent', $result['nest']['detail']);
        $this->assertArrayHasKey('ignore', $result['nest']['detail']);
        $this->assertArrayHasKey('override', $result['nest']['detail']);

        $this->assertEquals('MockNested', $result['class']);
        $this->assertEquals('default', $result['static']);
        $this->assertEquals('false', $result['simple']);
        $this->assertEquals('MockNested', $result['nest']['name']);
        $this->assertEquals('nested', $result['nest']['detail']['type']);
        $this->assertEquals('none', $result['nest']['detail']['parent']);
        $this->assertEquals('true', $result['nest']['detail']['ignore']);
        $this->assertEquals('false', $result['nest']['detail']['override']);
    }


    /**
     * @expects
     * public static $default = [
     *   'class'     => 'MockInheritNested',
     *   'static'    => 'default',
     *   'simple'    => 'false',
     *   'nest'      => [
     *      'name'  => 'MockInheritNested',
     *      'detail' => [
     *          'type'      => 'nested',
     *          'parent'    => 'MockNested',
     *          'ignore'    => 'true',
     *          'override'  => 'true',
     *      ]
     *   ]
     * ];
     */
    public function testInheritNested()
    {
        $result = \Hive\Config\Instance::MockInheritNested();

        $this->assertArrayHasKey('class', $result);
        $this->assertArrayHasKey('static', $result);
        $this->assertArrayHasKey('simple', $result);
        $this->assertArrayHasKey('nest', $result);
        $this->assertArrayHasKey('name', $result['nest']);
        $this->assertArrayHasKey('detail', $result['nest']);
        $this->assertArrayHasKey('type', $result['nest']['detail']);
        $this->assertArrayHasKey('parent', $result['nest']['detail']);
        $this->assertArrayHasKey('ignore', $result['nest']['detail']);
        $this->assertArrayHasKey('override', $result['nest']['detail']);

        $this->assertEquals('MockInheritNested', $result['class']);
        $this->assertEquals('default', $result['static']);
        $this->assertEquals('false', $result['simple']);
        $this->assertEquals('MockInheritNested', $result['nest']['name']);
        $this->assertEquals('nested', $result['nest']['detail']['type']);
        $this->assertEquals('MockNested', $result['nest']['detail']['parent']);
        $this->assertEquals('true', $result['nest']['detail']['ignore']);
        $this->assertEquals('true', $result['nest']['detail']['override']);
    }


    public function testNestedArguments()
    {

        $result = \Hive\Config\Instance::MockNested('class');
        $this->assertEquals('MockNested', $result);

        $result = \Hive\Config\Instance::MockNested('nest', 'name');
        $this->assertEquals('MockNested', $result);

        $result = \Hive\Config\Instance::MockNested('nest', 'detail');
        $this->assertArrayHasKey('type', $result);
        $this->assertArrayHasKey('parent', $result);
        $this->assertArrayHasKey('ignore', $result);
        $this->assertArrayHasKey('override', $result);

        $result = \Hive\Config\Instance::MockNested('nest', 'detail', 'type');
        $this->assertEquals('nested', $result);

        $result = \Hive\Config\Instance::MockNested('nest', 'detail', 'parent');
        $this->assertEquals('none', $result);

        $result = \Hive\Config\Instance::MockNested('nest', 'detail', 'ignore');
        $this->assertEquals('true', $result);

        $result = \Hive\Config\Instance::MockNested('nest', 'detail', 'override');
        $this->assertEquals('false', $result);

    }



    public function testInstanceDoesNotExistException ()
    {
        $this->setExpectedException('Hive\Config\Exception\ClassDoesNotExist');

        $config = \Hive\Config\Instance::Environment();

    }


    public function tearDown()
    {
        \Hive\Config\Instance::destroy();
    }


}
