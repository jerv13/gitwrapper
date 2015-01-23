<?php
/**
 * Test for the Branch argument
 *
 * This file contains test for the Branch argument
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
 * Test for the Branch argument
 *
 * Test for the Branch argument
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

class BranchArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\BranchArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\BranchArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\BranchArgument', class_uses($this->argument)));
    }

    /**
     * Test Branch
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BranchArgument
     */
    public function testBranch()
    {
        $name = 'My Branch Name';

        $this->argument->branch($name);
        $this->assertEquals(
            $name,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'branch')
        );
    }

    /**
     * Test Branch Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BranchArgument
     */
    public function testBranchEmpty()
    {
        $name = 'My Branch Name';
        $this->argument->branch($name)->branch('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'branch'));
    }


    /**
     * Test the getBranch method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BranchArgument
     */
    public function testGetBranch()
    {
        $name = 'My Branch Name';
        
        $expected = ' --branch=\'My Branch Name\'';
        $result = $this->argument->branch($name)->getBranch();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getBranch method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BranchArgument
     */
    public function testGetBranchReturnsEmptyString()
    {
        $result = $this->argument->getBranch();
        $this->assertEmpty($result);
    }
}
