<?php
/**
 * Test for the Patch argument
 *
 * This file contains test for the Patch argument
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
 * Test for the Patch argument
 *
 * Test for the Patch argument
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

class PatchArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\PatchArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\PatchArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\PatchArgument', class_uses($this->argument)));
    }

    /**
     * Test Patch
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PatchArgument
     */
    public function testPatch()
    {
        $this->argument->patch();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'patch'));
    }

    /**
     * Test Patch False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PatchArgument
     */
    public function testPatchFalse()
    {
        $this->argument->patch()->patch();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'patch'));
    }

    /*
     *  p Alias Property
     */

    /**
     * Test p
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PatchArgument
     */
    public function testP()
    {
        $this->argument->p();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'patch'));
    }

    /**
     * Test p False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PatchArgument
     */
    public function testPFalse()
    {
        $this->argument->p()->p();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'patch'));
    }


    /**
     * Test the getPatch method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PatchArgument
     */
    public function testGetPatch()
    {
        $expected = ' --patch';
        $result = $this->argument->patch()->getPatch();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getPatch method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PatchArgument
     */
    public function testGetPatchReturnsEmptyString()
    {
        $result = $this->argument->getPatch();
        $this->assertEmpty($result);
    }
}
