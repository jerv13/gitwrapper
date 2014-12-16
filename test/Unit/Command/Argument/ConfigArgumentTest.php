<?php
/**
 * Test for the Config argument
 *
 * This file contains test for the Config argument
 *
 * PHP version 5.4
 *
 * LICENSE: BSD
 *
 * @category  Reliv
 * @package   Git
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 * @link      https://github.com/reliv
 */

namespace Reliv\GitTest\Unit\Command\Argument;

require_once __DIR__ . '/../../../autoload.php';


/**
 * Test for the Config argument
 *
 * Test for the Config argument
 *
 * PHP version 5.4
 *
 * LICENSE: BSD
 *
 * @category  Reliv
 * @package   Git
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: 1.0
 * @link      https://github.com/reliv
 */

class ConfigArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\ConfigArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ConfigArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ConfigArgument', class_uses($this->argument)));
    }

    /**
     * Test Config
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ConfigArgument
     */
    public function testConfig()
    {
        $fakeConfig = array(
            'someKey'  => 'someValue',
            'someKey2' => 'someValue2',
            'someKey3' => 'someValue3',
        );

        $this->argument->config($fakeConfig);
        $this->assertEquals(
            $fakeConfig,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'config')
        );
    }

    /**
     * Test Config Not Array
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ConfigArgument
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testConfigNotArray()
    {
        $fakeConfig = 'someValue';
        $this->argument->config($fakeConfig);
    }

    /**
     * Test the getConfig method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ConfigArgument
     */
    public function testGetConfig()
    {
        $fakeConfig = array(
            'someKey'  => 'someValue',
            'someKey2' => 'someValue2',
            'someKey3' => 'someValue3',
        );

        $expected = ' --config \'someKey\'=\'someValue\'';
        $expected .= ' --config \'someKey2\'=\'someValue2\'';
        $expected .= ' --config \'someKey3\'=\'someValue3\'';

        $result = $this->argument->config($fakeConfig)->getConfig();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getConfig method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ConfigArgument
     */
    public function testGetConfigReturnsEmptyString()
    {
        $result = $this->argument->getConfig();
        $this->assertEmpty($result);
    }

}
