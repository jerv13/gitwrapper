<?php
/**
 * Test for the Conflict argument
 *
 * This file contains test for the Conflict argument
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
 * Test for the Conflict argument
 *
 * Test for the Conflict argument
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

class ConflictArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\ConflictArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ConflictArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ConflictArgument', class_uses($this->argument)));
    }

    /**
     * Test Conflict
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ConflictArgument
     */
    public function testConflict()
    {
        $this->argument->conflict('diff3');
        $this->assertEquals(
            'diff3',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'conflict')
        );
    }

    /**
     * Test Conflict Default
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ConflictArgument
     */
    public function testConflictDefault()
    {
        $this->argument->conflict();
        $this->assertEquals(
            'merge',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'conflict')
        );
    }

    /**
     * Test Conflict False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ConflictArgument
     */
    public function testConflictFalse()
    {
        $this->argument->conflict('diff3')->conflict('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'conflict'));
    }

    /**
     * Test Conflict Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ConflictArgument
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testConflictInvalid()
    {
        $this->argument->conflict('invalid');
    }

    /**
     * Test the getConflict method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ConflictArgument
     */
    public function testGetConflict()
    {
        $expected = ' --conflict=\'diff3\'';
        $result = $this->argument->conflict('diff3')->getConflict();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getConflict method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ConflictArgument
     */
    public function testGetConflictReturnsEmptyString()
    {
        $result = $this->argument->getConflict();
        $this->assertEmpty($result);
    }

}
