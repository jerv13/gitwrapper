<?php
/**
 * Test for the ShortLongPorcelain argument
 *
 * This file contains test for the ShortLongPorcelain argument
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
 * Test for the ShortLongPorcelain argument
 *
 * Test for the ShortLongPorcelain argument
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

class ShortLongPorcelainArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\ShortLongPorcelainArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ShortLongPorcelainArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ShortLongPorcelainArgument', class_uses($this->argument)));
    }

    /*
     *  Short Property
     */

    /**
     * Test Short
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testShort()
    {
        $this->argument->short();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'short'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'porcelain'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'long'));
    }

    /**
     * Test Short False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testShortFalse()
    {
        $this->argument->short()->short();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'short'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'porcelain'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'long'));
    }

    /*
     *  S Alias
     */

    /**
     * Test S
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testS()
    {
        $this->argument->s();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'short'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'short'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'porcelain'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'long'));
    }

    /**
     * Test S False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testSFalse()
    {
        $this->argument->s()->s();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'short'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'short'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'porcelain'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'long'));
    }

    /*
     *  Porcelain Property
     */

    /**
     * Test Porcelain
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testPorcelain()
    {
        $this->argument->porcelain();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'porcelain'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'short'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'long'));
    }

    /**
     * Test Porcelain False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testPorcelainFalse()
    {
        $this->argument->porcelain()->porcelain();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'porcelain'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'short'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'long'));
    }

    /*
     *  Long Property
     */

    /**
     * Test Long
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testLong()
    {
        $this->argument->long();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'long'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'short'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'porcelain'));
    }

    /**
     * Test Long False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testLongFalse()
    {
        $this->argument->long()->long();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'long'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'short'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'porcelain'));
    }

    /**
     * Test the getShortLongPorcelain method with short
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testGetShortLongPorcelainWithShort()
    {
        $expected = ' --short';
        $result = $this->argument->short()->getShortLongPorcelain();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getShortLongPorcelain method with long
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testGetShortLongPorcelainWithLong()
    {
        $expected = ' --long';
        $result = $this->argument->long()->getShortLongPorcelain();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getShortLongPorcelain method with long
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testGetShortLongPorcelainWithPorcelain()
    {
        $expected = ' --porcelain';
        $result = $this->argument->porcelain()->getShortLongPorcelain();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getShortLongPorcelain method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ShortLongPorcelainArgument
     */
    public function testGetShortLongPorcelainReturnsEmptyString()
    {
        $result = $this->argument->getShortLongPorcelain();
        $this->assertEmpty($result);
    }

}
