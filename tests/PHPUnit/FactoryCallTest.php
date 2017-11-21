<?php

/**
* Class testInstance
 *
 * Test the instance setup
*/
class testCallFactory extends base
{

    /**
     * Sanity check against php unit.
     */
    public function testSanity ()
    {
        $this->assertEquals(1 + 1, 2);
    }

    public function testSimpleFactory ()
    {

        $factory = new\Hive\Config\Factory();
        $config = $factory->MockSimple();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);
    }

    public function testInheritFactory ()
    {

        $factory = new\Hive\Config\Factory();
        $config = $factory->MockInherit();


        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);
        $this->assertArrayHasKey('inherit', $config);

        $this->assertEquals('MockInherit', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);
        $this->assertEquals('true', $config['inherit']);

    }


    public function testConfigNamespaceFactory ()
    {

        $settings = ['namespaces' => ['','\\Config']];
        $factory = new\Hive\Config\Factory($settings);
        $config = $factory->MockNamespace();

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

        $settings = [
            'namespaces' => [
                '',
                '\\Shared\\Config'
            ]
        ];

        $factory = new\Hive\Config\Factory($settings);
        $config = $factory->MockNamespace();

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

        $settings = [
            'namespaces' => [
                '',
                '\\Config',
                '\\Shared\\Config'
            ]
        ];

        $factory = new\Hive\Config\Factory($settings);
        $config = $factory->MockNamespace();

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

        $factory = new\Hive\Config\Factory();
        $config = $factory->MockSimple();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);

        $config2 = $factory->MockSimple();

        $this->assertArrayHasKey('class', $config2);
        $this->assertArrayHasKey('static', $config2);
        $this->assertArrayHasKey('simple', $config2);

        $this->assertEquals('MockSimple', $config2['class']);
        $this->assertEquals('default', $config2['static']);
        $this->assertEquals('true', $config2['simple']);


    }

    public function testSimpleArguments()
    {
        $factory = new\Hive\Config\Factory();
        $class = $factory->MockSimple('class');

        $this->assertEquals('MockSimple', $class);


    }


    public function testInheritArguments()
    {

        $factory = new\Hive\Config\Factory();
        $simple = $factory->MockInherit('simple');

        $this->assertEquals('true', $simple);

    }

    public function testInheritSameArguments()
    {
        $factory = new\Hive\Config\Factory();
        $static = $factory->MockInherit('static');

        $this->assertEquals('default', $static);

    }



    public function testInheritChangedArguments()
    {
        $factory = new\Hive\Config\Factory();
        $class = $factory->MockInherit('class');

        $this->assertEquals('MockInherit', $class);

    }


    public function testArgumentsDoesNotExistException()
    {
        $this->setExpectedException('Hive\Config\Exception\ClassDoesNotExist');

        $factory = new\Hive\Config\Factory();
        $class = $factory->BABABABA('class');


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
        $factory = new\Hive\Config\Factory();
        $result = $factory->MockNested();

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
        $factory = new\Hive\Config\Factory();
        $result = $factory->MockInheritNested();

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
        $factory = new\Hive\Config\Factory();
        $result = $factory->MockNested('class');


        $this->assertEquals('MockNested', $result);

        $result = $factory->MockNested('nest', 'name');
        $this->assertEquals('MockNested', $result);

        $result = $factory->MockNested('nest', 'detail');
        $this->assertArrayHasKey('type', $result);
        $this->assertArrayHasKey('parent', $result);
        $this->assertArrayHasKey('ignore', $result);
        $this->assertArrayHasKey('override', $result);

        $result = $factory->MockNested('nest', 'detail', 'type');
        $this->assertEquals('nested', $result);

        $result = $factory->MockNested('nest', 'detail', 'parent');
        $this->assertEquals('none', $result);

        $result = $factory->MockNested('nest', 'detail', 'ignore');
        $this->assertEquals('true', $result);

        $result = $factory->MockNested('nest', 'detail', 'override');
        $this->assertEquals('false', $result);

    }



    public function testClassDoesNotExistException ()
    {
        $this->setExpectedException('Hive\Config\Exception\ClassDoesNotExist');

        $factory = new\Hive\Config\Factory();
        $result = $factory->Environment();

    }


}
