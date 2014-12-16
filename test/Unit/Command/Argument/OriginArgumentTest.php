<?php
/**
 * Test for the Origin argument
 *
 * This file contains test for the Origin argument
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
 * Test for the Origin argument
 *
 * Test for the Origin argument
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

class OriginArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\OriginArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\OriginArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\OriginArgument', class_uses($this->argument)));
    }

    /**
     * Test Origin
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OriginArgument
     */
    public function testOrigin()
    {
        $name = 'My New Name';

        $this->argument->origin($name);
        $this->assertEquals(
            $name,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'origin')
        );
    }

    /**
     * Test Origin Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OriginArgument
     */
    public function testOriginEmpty()
    {
        $name = 'origin';

        $this->argument->origin('');
        $this->assertEquals(
            $name,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'origin')
        );
    }

    /**
     * Test Origin Incorrect Case
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OriginArgument
     */
    public function testOriginIncorrectCase()
    {
        $name = 'OrIgin';

        $this->argument->origin($name);
        $this->assertEquals(
            'origin',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'origin')
        );
    }

    /**
     * Test the getOrigin method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OriginArgument
     */
    public function testGetOrigin()
    {
        $expected = ' --origin=\'someName\'';
        $result = $this->argument->origin('someName')->getOrigin();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getOrigin method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OriginArgument
     */
    public function testGetOriginReturnsEmptyString()
    {
        $result = $this->argument->getOrigin();
        $this->assertEmpty($result);
    }

    /**
     * Test the getOrigin method returns empty string when origin is name
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OriginArgument
     */
    public function testGetOriginReturnsEmptyStringWithOriginAsName()
    {
        $result = $this->argument->getOrigin('origin');
        $this->assertEmpty($result);
    }
}
