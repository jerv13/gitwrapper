<?php
/**
 * Test for the L argument
 *
 * This file contains test for the L argument
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
 * Test for the L argument
 *
 * Test for the L argument
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

class LArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\LArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\LArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\LArgument', class_uses($this->argument)));
    }

    /**
     * Test L
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LArgument
     */
    public function testL()
    {
        $this->argument->l();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'l'));
    }

    /**
     * Test L False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LArgument
     */
    public function testLFalse()
    {
        $this->argument->l()->l();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'l'));
    }

    /**
     * Test the getL method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LArgument
     */
    public function testGetL()
    {
        $expected = ' -l';
        $result = $this->argument->l()->getL();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getL method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LArgument
     */
    public function testGetLReturnsEmptyString()
    {
        $result = $this->argument->getL();
        $this->assertEmpty($result);
    }

}
