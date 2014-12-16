<?php
/**
 * Test for the Quiet argument
 *
 * This file contains test for the Quiet argument
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
 * Test for the Quiet argument
 *
 * Test for the Quiet argument
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

class QuietArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\QuietArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\QuietArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\QuietArgument', class_uses($this->argument)));
    }

    /**
     * Test quiet
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\QuietArgument
     */
    public function testQuiet()
    {
        $this->argument->quiet();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'quiet'));
    }

    /**
     * Test quiet False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\QuietArgument
     */
    public function testQuietFalse()
    {
        $this->argument->quiet()->quiet();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'quiet'));
    }

    /*
     *  Q Alias Property
     */

    /**
     * Test q
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\QuietArgument
     */
    public function testQ()
    {
        $this->argument->q();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'quiet'));
    }

    /**
     * Test q False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\QuietArgument
     */
    public function testQFalse()
    {
        $this->argument->q()->q();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'quiet'));
    }


    /**
     * Test the getQuiet method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\QuietArgument
     */
    public function testGetQuiet()
    {
        $expected = ' --quiet';
        $result = $this->argument->quiet()->getQuiet();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getQuiet method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\QuietArgument
     */
    public function testGetQuietReturnsEmptyString()
    {
        $result = $this->argument->getQuiet();
        $this->assertEmpty($result);
    }

}
