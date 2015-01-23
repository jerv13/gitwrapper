<?php
/**
 * Test for the RecurseSubmodules argument
 *
 * This file contains test for the RecurseSubmodules argument
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
 * Test for the RecurseSubmodules argument
 *
 * Test for the RecurseSubmodules argument
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

class RecurseSubmodulesArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\RecurseSubmodulesArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\RecurseSubmodulesArgument');
        $this->assertTrue(
            in_array('Reliv\Git\Command\Argument\RecurseSubmodulesArgument', class_uses($this->argument))
        );
    }

    /**
     * Test RecurseSubmodules
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecurseSubmodulesArgument
     */
    public function testRecurseSubmodules()
    {
        $expected = 'on-demand';
        $this->argument->recurseSubmodules($expected);
        $this->assertEquals(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'recurseSubmodules')
        );
    }

    /**
     * Test RecurseSubmodules Default
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecurseSubmodulesArgument
     */
    public function testRecurseSubmodulesDefaults()
    {
        $expected = 'yes';
        $this->argument->recurseSubmodules();
        $this->assertEquals(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'recurseSubmodules')
        );
    }

    /**
     * Test RecurseSubmodules True
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecurseSubmodulesArgument
     */
    public function testRecurseSubmodulesTrue()
    {
        $expected = 'yes';
        $this->argument->recurseSubmodules(true);
        $this->assertEquals(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'recurseSubmodules')
        );
    }

    /**
     * Test RecurseSubmodules False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecurseSubmodulesArgument
     */
    public function testRecurseSubmodulesFalse()
    {
        $expected = 'no';
        $this->argument->recurseSubmodules(false);
        $this->assertEquals(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'recurseSubmodules')
        );
    }

    /**
     * Test RecurseSubmodules False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecurseSubmodulesArgument
     */
    public function testRecurseSubmodulesEmpty()
    {
        $this->argument->recurseSubmodules()->recurseSubmodules('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'recurseSubmodules'));
    }

    /**
     * Test RecurseSubmodules Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecurseSubmodulesArgument
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testRecurseSubmodulesInvalid()
    {
        $this->argument->recurseSubmodules('invalid');
    }


    /**
     * Test NoRecurseSubmodules
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecurseSubmodulesArgument
     */
    public function testNoRecurseSubmodules()
    {
        $this->argument->recurseSubmodules()->noRecurseSubmodules();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noRecurseSubmodules'));
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'recurseSubmodules'));
    }

    /**
     * Test RecurseSubmodules False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecurseSubmodulesArgument
     */
    public function testNoRecurseSubmodulesFalse()
    {
        $this->argument->noRecurseSubmodules()->noRecurseSubmodules();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noRecurseSubmodules'));
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'recurseSubmodules'));
    }

    /**
     * Test the getRecurseSubmodules method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecurseSubmodulesArgument
     */
    public function testGetRecurseSubmodules()
    {
        $expected = ' --recurse-submodules=\'on-demand\'';
        $result = $this->argument->recurseSubmodules('on-demand')->getRecurseSubmodules();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getRecurseSubmodules method with noRecurseSubmodulesSet
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecurseSubmodulesArgument
     */
    public function testGetRecurseSubmodulesWithNoRecurseSubmodulesSet()
    {
        $expected = ' --no-recurse-submodules';
        $result = $this->argument->noRecurseSubmodules()->getRecurseSubmodules();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getRecurseSubmodules method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RecurseSubmodulesArgument
     */
    public function testGetRecurseSubmodulesReturnsEmptyString()
    {
        $result = $this->argument->getRecurseSubmodules();
        $this->assertEmpty($result);
    }
}
