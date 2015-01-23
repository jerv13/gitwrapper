<?php
/**
 * Test for the Append argument
 *
 * This file contains test for the Append argument
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
 * Test for the Append argument
 *
 * Test for the Append argument
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

class AppendArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\AppendArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\AppendArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\AppendArgument', class_uses($this->argument)));
    }

    /**
     * Test Append
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\AppendArgument
     */
    public function testAppend()
    {
        $this->argument->append();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'append'));
    }

    /**
     * Test Append False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\AppendArgument
     */
    public function testAppendFalse()
    {
        $this->argument->append()->append();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'append'));
    }

    /*
     *  l Alias Property
     */

    /**
     * Test a
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\AppendArgument
     */
    public function testA()
    {
        $this->argument->a();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'append'));
    }

    /**
     * Test A False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\AppendArgument
     */
    public function testLFalse()
    {
        $this->argument->a()->a();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'append'));
    }


    /**
     * Test the getAppend method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\AppendArgument
     */
    public function testGetAppend()
    {
        $expected = ' --append';
        $result = $this->argument->append()->getAppend();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getAppend method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\AppendArgument
     */
    public function testGetAppendReturnsEmptyString()
    {
        $result = $this->argument->getAppend();
        $this->assertEmpty($result);
    }
}
