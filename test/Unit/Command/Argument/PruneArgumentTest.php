<?php
/**
 * Test for the Prune argument
 *
 * This file contains test for the Prune argument
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
 * Test for the Prune argument
 *
 * Test for the Prune argument
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

class PruneArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\PruneArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\PruneArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\PruneArgument', class_uses($this->argument)));
    }

    /**
     * Test Prune
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PruneArgument
     */
    public function testPrune()
    {
        $this->argument->prune();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'prune'));
    }

    /**
     * Test Prune False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PruneArgument
     */
    public function testPruneFalse()
    {
        $this->argument->prune()->prune();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'prune'));
    }

    /*
     *  P Alias Property
     */

    /**
     * Test P
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PruneArgument
     */
    public function testP()
    {
        $this->argument->p();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'prune'));
    }

    /**
     * Test P False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PruneArgument
     */
    public function testPFalse()
    {
        $this->argument->p()->p();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'prune'));
    }


    /**
     * Test the getPrune method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PruneArgument
     */
    public function testGetPrune()
    {
        $expected = ' --prune';
        $result = $this->argument->prune()->getPrune();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getPrune method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PruneArgument
     */
    public function testGetPruneReturnsEmptyString()
    {
        $result = $this->argument->getPrune();
        $this->assertEmpty($result);
    }

}
