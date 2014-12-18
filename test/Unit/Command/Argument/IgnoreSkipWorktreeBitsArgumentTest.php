<?php
/**
 * Test for the IgnoreSkipWorktreeBits argument
 *
 * This file contains test for the IgnoreSkipWorktreeBits argument
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
 * Test for the IgnoreSkipWorktreeBits argument
 *
 * Test for the IgnoreSkipWorktreeBits argument
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

class IgnoreSkipWorktreeBitsArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\IgnoreSkipWorktreeBitsArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\IgnoreSkipWorktreeBitsArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\IgnoreSkipWorktreeBitsArgument', class_uses($this->argument)));
    }

    /**
     * Test IgnoreSkipWorktreeBits
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoreSkipWorktreeBitsArgument
     */
    public function testIgnoreSkipWorktreeBits()
    {
        $this->argument->ignoreSkipWorktreeBits();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'ignoreSkipWorktreeBits'));
    }

    /**
     * Test IgnoreSkipWorktreeBits False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoreSkipWorktreeBitsArgument
     */
    public function testIgnoreSkipWorktreeBitsFalse()
    {
        $this->argument->ignoreSkipWorktreeBits()->ignoreSkipWorktreeBits();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'ignoreSkipWorktreeBits'));
    }

    /**
     * Test the getIgnoreSkipWorktreeBits method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoreSkipWorktreeBitsArgument
     */
    public function testGetIgnoreSkipWorktreeBits()
    {
        $expected = ' --ignore-skip-worktree-bits';
        $result = $this->argument->ignoreSkipWorktreeBits()->getIgnoreSkipWorktreeBits();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getIgnoreSkipWorktreeBits method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\IgnoreSkipWorktreeBitsArgument
     */
    public function testGetIgnoreSkipWorktreeBitsReturnsEmptyString()
    {
        $result = $this->argument->getIgnoreSkipWorktreeBits();
        $this->assertEmpty($result);
    }
}
