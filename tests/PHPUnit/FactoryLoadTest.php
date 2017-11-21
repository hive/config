<?php

/**
* Class testInstance
 *
 * Test the instance setup
*/
class testLoadFactory extends base
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
        $config = $factory->load('MockSimple');

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
        $config = $factory->load('MockInherit');


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
        $config = $factory->load('MockNamespace');

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
        $config = $factory->load('MockNamespace');

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
        $config = $factory->load('MockNamespace');

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
        $config = $factory->load('MockSimple');

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);

        $config = $factory->load('MockSimple');

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);


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
        $config = $factory->load('MockNested');

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);
        $this->assertArrayHasKey('nest', $config);
        $this->assertArrayHasKey('name', $config['nest']);
        $this->assertArrayHasKey('detail', $config['nest']);
        $this->assertArrayHasKey('type', $config['nest']['detail']);
        $this->assertArrayHasKey('parent', $config['nest']['detail']);
        $this->assertArrayHasKey('ignore', $config['nest']['detail']);
        $this->assertArrayHasKey('override', $config['nest']['detail']);

        $this->assertEquals('MockNested', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('false', $config['simple']);
        $this->assertEquals('MockNested', $config['nest']['name']);
        $this->assertEquals('nested', $config['nest']['detail']['type']);
        $this->assertEquals('none', $config['nest']['detail']['parent']);
        $this->assertEquals('true', $config['nest']['detail']['ignore']);
        $this->assertEquals('false', $config['nest']['detail']['override']);
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
        $config = $factory->load('MockInheritNested');

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);
        $this->assertArrayHasKey('nest', $config);
        $this->assertArrayHasKey('name', $config['nest']);
        $this->assertArrayHasKey('detail', $config['nest']);
        $this->assertArrayHasKey('type', $config['nest']['detail']);
        $this->assertArrayHasKey('parent', $config['nest']['detail']);
        $this->assertArrayHasKey('ignore', $config['nest']['detail']);
        $this->assertArrayHasKey('override', $config['nest']['detail']);

        $this->assertEquals('MockInheritNested', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('false', $config['simple']);
        $this->assertEquals('MockInheritNested', $config['nest']['name']);
        $this->assertEquals('nested', $config['nest']['detail']['type']);
        $this->assertEquals('MockNested', $config['nest']['detail']['parent']);
        $this->assertEquals('true', $config['nest']['detail']['ignore']);
        $this->assertEquals('true', $config['nest']['detail']['override']);
    }






    public function testInstanceDoesNotExistException ()
    {
        $this->setExpectedException('Hive\Config\Exception\ClassDoesNotExist');

        $factory = new\Hive\Config\Factory();
        $config = $factory->load('DoesNotExist');

    }



}
