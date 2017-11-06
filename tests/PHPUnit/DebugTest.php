<?php

/**
* Class testInstance
 *
 * Test the instance setup
*/
class testDebug extends base
{



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
        $instance = new \hive\Config\Instance();

        $result = $instance::MockInheritNested();

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




    public function tearDown()
    {
        \Hive\Config\Instance::destroy();
    }


}
