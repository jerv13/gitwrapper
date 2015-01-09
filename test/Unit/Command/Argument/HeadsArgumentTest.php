<?php
/**
 * Test for the Heads argument
 *
 * This file contains test for the Heads argument
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
 * Test for the Heads argument
 *
 * Test for the Heads argument
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

class HeadsArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\HeadsArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\HeadsArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\HeadsArgument', class_uses($this->argument)));
    }

    /**
     * Test Heads
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HeadsArgument
     */
    public function testHeads()
    {
        $this->argument->heads();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'heads'));
    }

    /**
     * Test Heads False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HeadsArgument
     */
    public function testHeadsFalse()
    {
        $this->argument->heads()->heads();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'heads'));
    }

    /*
     * h Alias
     */
    /**
     * Test Heads
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HeadsArgument
     */
    public function testHAlias()
    {
        $this->argument->h();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'heads'));
    }

    /**
     * Test Heads False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HeadsArgument
     */
    public function testHAliasFalse()
    {
        $this->argument->h()->h();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'heads'));
    }

    /**
     * Test the getHeads method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HeadsArgument
     */
    public function testGetHeads()
    {
        $expected = ' --heads';
        $result = $this->argument->heads()->getHeads();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getHeads method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HeadsArgument
     */
    public function testGetHeadsReturnsEmptyString()
    {
        $result = $this->argument->getHeads();
        $this->assertEmpty($result);
    }

}
