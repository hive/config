<?php

/**
* Class testInstance
 *
 * Test the instance setup
*/
class testObject extends base
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

    public function testExistingConfig()
    {
        $config = new \MockSimple();

        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);

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


    public function testNamespace()
    {
        $config = new \Config\MockNamespace();
        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);
        $this->assertArrayHasKey('namespace', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);
        $this->assertEquals('Config', $config['namespace']);
    }


    public function testDeepNamespace()
    {
        $config = new \Shared\Config\MockNamespace();
        $this->assertArrayHasKey('class', $config);
        $this->assertArrayHasKey('static', $config);
        $this->assertArrayHasKey('simple', $config);
        $this->assertArrayHasKey('namespace', $config);

        $this->assertEquals('MockSimple', $config['class']);
        $this->assertEquals('default', $config['static']);
        $this->assertEquals('true', $config['simple']);
        $this->assertEquals('Shared\Config', $config['namespace']);
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
        $result = new \MockNested();

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
        $result = new \MockInheritNested();

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


}
