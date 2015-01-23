<?php
/**
 * Test for the Ignored argument
 *
 * This file contains test for the Ignored argument
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
 * Test for the Ignored argument
 *
 * Test for the Ignored argument
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

class IgnoredArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\IgnoredArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\IgnoredArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\IgnoredArgument', class_uses($this->argument)));
    }

    /**
     * Test Ignored
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoredArgument
     */
    public function testIgnored()
    {
        $this->argument->ignored();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'ignored'));
    }

    /**
     * Test Ignored False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoredArgument
     */
    public function testIgnoredFalse()
    {
        $this->argument->ignored()->ignored();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'ignored'));
    }


    /**
     * Test the getIgnored method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoredArgument
     */
    public function testGetIgnored()
    {
        $expected = ' --ignored';
        $result = $this->argument->ignored()->getIgnored();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getIgnored method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoredArgument
     */
    public function testGetIgnoredReturnsEmptyString()
    {
        $result = $this->argument->getIgnored();
        $this->assertEmpty($result);
    }
}
