<?php
/**
 * Test for the IgnoreSubmodules argument
 *
 * This file contains test for the IgnoreSubmodules argument
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
 * Test for the IgnoreSubmodules argument
 *
 * Test for the IgnoreSubmodules argument
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

class IgnoreSubmodulesArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\IgnoreSubmodulesArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\IgnoreSubmodulesArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\IgnoreSubmodulesArgument', class_uses($this->argument)));
    }

    /**
     * Test IgnoreSubmodules
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoreSubmodulesArgument
     */
    public function testIgnoreSubmodules()
    {
        $this->argument->ignoreSubmodules('NonE');
        $this->assertEquals(
            'none',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'ignoreSubmodules')
        );
    }

    /**
     * Test IgnoreSubmodules Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoreSubmodulesArgument
     */
    public function testIgnoreSubmodulesEmpty()
    {
        $this->argument->ignoreSubmodules('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'ignoreSubmodules'));
    }

    /**
     * Test IgnoreSubmodules Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoreSubmodulesArgument
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testIgnoreSubmodulesInvalid()
    {
        $this->argument->ignoreSubmodules('invalid');
    }


    /**
     * Test the getIgnoreSubmodules method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoreSubmodulesArgument
     */
    public function testGetIgnoreSubmodules()
    {
        $expected = ' --ignore-submodules=\'none\'';
        $result = $this->argument->ignoreSubmodules('none')->getIgnoreSubmodules();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getIgnoreSubmodules method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoreSubmodulesArgument
     */
    public function testGetIgnoreSubmodulesReturnsEmptyString()
    {
        $result = $this->argument->getIgnoreSubmodules();
        $this->assertEmpty($result);
    }

}
