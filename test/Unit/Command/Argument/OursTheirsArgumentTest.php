<?php
/**
 * Test for the OursTheirs argument
 *
 * This file contains test for the OursTheirs argument
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
 * Test for the OursTheirs argument
 *
 * Test for the OursTheirs argument
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

class OursTheirsArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\OursTheirsArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\OursTheirsArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\OursTheirsArgument', class_uses($this->argument)));
    }

    /**
     * Test Ours
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OursTheirsArgument
     */
    public function testOurs()
    {
        $this->argument->ours();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'ours'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'theirs'));
    }

    /**
     * Test Ours False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OursTheirsArgument
     */
    public function testOursTheirsFalse()
    {
        $this->argument->ours()->ours();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'ours'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'theirs'));
    }

    /**
     * Test Theirs
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OursTheirsArgument
     */
    public function testTheirs()
    {
        $this->argument->theirs();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'theirs'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'ours'));
    }

    /**
     * Test L False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OursTheirsArgument
     */
    public function testTheirsFalse()
    {
        $this->argument->theirs()->theirs();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'theirs'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'ours'));
    }


    /**
     * Test the getOursTheirs method with ours
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OursTheirsArgument
     */
    public function testGetOursTheirsWithOurs()
    {
        $expected = ' --ours';
        $result = $this->argument->ours()->getOursTheirs();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getOursTheirs method with ours
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OursTheirsArgument
     */
    public function testGetOursTheirsWithTheirs()
    {
        $expected = ' --theirs';
        $result = $this->argument->theirs()->getOursTheirs();
        $this->assertEquals($expected, $result);
    }


    /**
     * Test the getOursTheirs method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OursTheirsArgument
     */
    public function testGetOursTheirsReturnsEmptyString()
    {
        $result = $this->argument->getOursTheirs();
        $this->assertEmpty($result);
    }

}
