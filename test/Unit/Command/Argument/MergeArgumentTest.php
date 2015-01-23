<?php
/**
 * Test for the Merge argument
 *
 * This file contains test for the Merge argument
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
 * Test for the Merge argument
 *
 * Test for the Merge argument
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

class MergeArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\MergeArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\MergeArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\MergeArgument', class_uses($this->argument)));
    }

    /**
     * Test Merge
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MergeArgument
     */
    public function testMerge()
    {
        $this->argument->merge();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'merge'));
    }

    /**
     * Test Merge False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MergeArgument
     */
    public function testMergeFalse()
    {
        $this->argument->merge()->merge();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'merge'));
    }

    /*
     *  l Alias Property
     */

    /**
     * Test m
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MergeArgument
     */
    public function testM()
    {
        $this->argument->m();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'merge'));
    }

    /**
     * Test M False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MergeArgument
     */
    public function testMFalse()
    {
        $this->argument->m()->m();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'merge'));
    }


    /**
     * Test the getMerge method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MergeArgument
     */
    public function testGetMerge()
    {
        $expected = ' --merge';
        $result = $this->argument->merge()->getMerge();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getMerge method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MergeArgument
     */
    public function testGetMergeReturnsEmptyString()
    {
        $result = $this->argument->getMerge();
        $this->assertEmpty($result);
    }
}
