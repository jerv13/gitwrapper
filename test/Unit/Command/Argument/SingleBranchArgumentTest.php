<?php
/**
 * Test for the SingleBranch argument
 *
 * This file contains test for the SingleBranch argument
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
 * Test for the SingleBranch argument
 *
 * Test for the SingleBranch argument
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

class SingleBranchArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\SingleBranchArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\SingleBranchArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\SingleBranchArgument', class_uses($this->argument)));
    }

    /**
     * Test SingleBranch
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SingleBranchArgument
     */
    public function testSingleBranch()
    {
        $this->argument->singleBranch();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'singleBranch'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noSingleBranch'));
    }

    /**
     * Test SingleBranch False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SingleBranchArgument
     */
    public function testSingleBranchFalse()
    {
        $this->argument->singleBranch()->singleBranch();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'singleBranch'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noSingleBranch'));
    }

    /*
     *  NoSingleBranch Property
     */

    /**
     * Test NoSingleBranch
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SingleBranchArgument
     */
    public function testNoSingleBranch()
    {
        $this->argument->noSingleBranch();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'singleBranch'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noSingleBranch'));
    }

    /**
     * Test NoSingleBranch False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SingleBranchArgument
     */
    public function testNoSingleBranchFalse()
    {
        $this->argument->noSingleBranch()->noSingleBranch();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'singleBranch'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noSingleBranch'));
    }

    /**
     * Test the getSingleBranch method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SingleBranchArgument
     */
    public function testGetSingleBranch()
    {
        $expected = ' --single-branch';
        $result = $this->argument->singleBranch()->getSingleBranch();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getSingleBranch method with noSingleBranch selected
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SingleBranchArgument
     */
    public function testGetSingleBranchWithNoSingleBranchSelected()
    {
        $expected = ' --no-single-branch';
        $result = $this->argument->noSingleBranch()->getSingleBranch();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getSingleBranch method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SingleBranchArgument
     */
    public function testGetSingleBranchReturnsEmptyString()
    {
        $result = $this->argument->getSingleBranch();
        $this->assertEmpty($result);
    }
}
