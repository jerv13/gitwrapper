<?php
/**
 * Test for the Shared Object argument
 *
 * This file contains test for the Shared Object argument
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
 * Test for the Shared Object argument
 *
 * Test for the Shared Object argument
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

class SharedObjectArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\SharedObjectArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\SharedObjectArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\SharedObjectArgument', class_uses($this->argument)));
    }


    /**
     * Test Shared
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedObjectArgument
     */
    public function testShared()
    {
        $this->argument->shared();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared'));
    }

    /**
     * Test Shared False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedObjectArgument
     */
    public function testSharedFalse()
    {
        $this->argument->shared()->shared();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared'));
    }

    /*
     *  S Alias Property
     */

    /**
     * Test S
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedObjectArgument
     */
    public function testS()
    {
        $this->argument->s();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared'));
    }

    /**
     * Test S False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedObjectArgument
     */
    public function testSFalse()
    {
        $this->argument->s()->s();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared'));
    }

    /**
     * Test the getShared method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedObjectArgument
     */
    public function testGetShared()
    {
        $expected = ' --shared';
        $result = $this->argument->shared()->getShared();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getShared method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedObjectArgument
     */
    public function testGetSharedReturnsEmptyString()
    {
        $result = $this->argument->getShared();
        $this->assertEmpty($result);
    }
}
