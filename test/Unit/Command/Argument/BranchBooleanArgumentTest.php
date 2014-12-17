<?php
/**
 * Test for the BranchBoolean argument
 *
 * This file contains test for the BranchBoolean argument
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
 * Test for the BranchBoolean argument
 *
 * Test for the BranchBoolean argument
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

class BranchBooleanArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\BranchBooleanArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\BranchBooleanArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\BranchBooleanArgument', class_uses($this->argument)));
    }

    /**
     * Test Branch
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BranchBooleanArgument
     */
    public function testBranch()
    {
        $this->argument->branch();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'branch'));
    }

    /**
     * Test Branch False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BranchBooleanArgument
     */
    public function testBranchFalse()
    {
        $this->argument->branch()->branch();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'branch'));
    }

    /*
     *  B Alias
     */

    /**
     * Test B
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BranchBooleanArgument
     */
    public function testB()
    {
        $this->argument->b();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'branch'));
    }

    /**
     * Test B False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BranchBooleanArgument
     */
    public function testBFalse()
    {
        $this->argument->b()->b();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'branch'));
    }


    /**
     * Test the getBranchBoolean method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BranchBooleanArgument
     */
    public function testGetBranchBoolean()
    {
        $expected = ' --branch';
        $result = $this->argument->branch()->getBranch();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getBranchBoolean method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BranchBooleanArgument
     */
    public function testGetBranchBooleanReturnsEmptyString()
    {
        $result = $this->argument->getBranch();
        $this->assertEmpty($result);
    }

}
