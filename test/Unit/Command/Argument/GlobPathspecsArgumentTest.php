<?php
/**
 * Test for the GlobPathspecs argument
 *
 * This file contains test for the GlobPathspecs argument
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
 * Test for the GlobPathspecs argument
 *
 * Test for the GlobPathspecs argument
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

class GlobPathspecsArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\GlobPathspecsArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\GlobPathspecsArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\GlobPathspecsArgument', class_uses($this->argument)));
    }

    /**
     * Test GlobPathspecs
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GlobPathspecsArgument
     */
    public function testGlobPathspecs()
    {
        $this->argument->globPathspecs();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'globPathspecs'));
    }

    /**
     * Test GlobPathspecs False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GlobPathspecsArgument
     */
    public function testGlobPathspecsFalse()
    {
        $this->argument->globPathspecs()->globPathspecs();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'globPathspecs'));
    }

    /*
     *  NoGlobPathspecs Property
     */

    /**
     * Test NoGlobPathspecs
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GlobPathspecsArgument
     */
    public function testNoGlobPathspecs()
    {
        $this->argument->noGlobPathspecs();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noGlobPathspecs'));
    }

    /**
     * Test NoGlobPathspecs False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GlobPathspecsArgument
     */
    public function testNoGlobPathspecsFalse()
    {
        $this->argument->noGlobPathspecs()->noGlobPathspecs();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noGlobPathspecs'));
    }


    /**
     * Test the getGlobPathspecs method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GlobPathspecsArgument
     */
    public function testGetGlobPathspecs()
    {
        $expected = ' --glob-pathspecs';
        $result = $this->argument->globPathspecs()->getGlobPathspecs();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getGlobPathspecs method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GlobPathspecsArgument
     */
    public function testGetGlobPathspecsWithNoGlobSet()
    {
        $expected = ' --noglob-pathspecs';
        $result = $this->argument->noGlobPathspecs()->getGlobPathspecs();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getGlobPathspecs method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GlobPathspecsArgument
     */
    public function testGetGlobPathspecsReturnsEmptyString()
    {
        $result = $this->argument->getGlobPathspecs();
        $this->assertEmpty($result);
    }
}
