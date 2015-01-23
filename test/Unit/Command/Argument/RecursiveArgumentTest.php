<?php
/**
 * Test for the Recursive argument
 *
 * This file contains test for the Recursive argument
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
 * Test for the Recursive argument
 *
 * Test for the Recursive argument
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

class RecursiveArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\RecursiveArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\RecursiveArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\RecursiveArgument', class_uses($this->argument)));
    }

    /**
     * Test Recursive
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecursiveArgument
     */
    public function testRecursive()
    {
        $this->argument->recursive();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'recursive'));
    }

    /**
     * Test Recursive False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecursiveArgument
     */
    public function testRecursiveFalse()
    {
        $this->argument->recursive()->recursive();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'recursive'));
    }

    /**
     * Test the getRecursive method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecursiveArgument
     */
    public function testGetRecursive()
    {
        $expected = ' --recursive';
        $result = $this->argument->recursive()->getRecursive();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getRecursive method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecursiveArgument
     */
    public function testGetRecursiveReturnsEmptyString()
    {
        $result = $this->argument->getRecursive();
        $this->assertEmpty($result);
    }
}
