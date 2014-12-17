<?php
/**
 * Test for the Unshallow argument
 *
 * This file contains test for the Unshallow argument
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
 * Test for the Unshallow argument
 *
 * Test for the Unshallow argument
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

class UnshallowArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\UnshallowArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\UnshallowArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\UnshallowArgument', class_uses($this->argument)));
    }

    /**
     * Test Unshallow
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UnshallowArgument
     */
    public function testUnshallow()
    {
        $this->argument->unshallow();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'unshallow'));
    }

    /**
     * Test Unshallow False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UnshallowArgument
     */
    public function testUnshallowFalse()
    {
        $this->argument->unshallow()->unshallow();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'unshallow'));
    }

    /**
     * Test the getUnshallow method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UnshallowArgument
     */
    public function testGetUnshallow()
    {
        $expected = ' --unshallow';
        $result = $this->argument->unshallow()->getUnshallow();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getUnshallow method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UnshallowArgument
     */
    public function testGetUnshallowReturnsEmptyString()
    {
        $result = $this->argument->getUnshallow();
        $this->assertEmpty($result);
    }

}
