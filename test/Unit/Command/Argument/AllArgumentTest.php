<?php
/**
 * Test for the All argument
 *
 * This file contains test for the All argument
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
 * Test for the All argument
 *
 * Test for the All argument
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

class AllArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\AllArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\AllArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\AllArgument', class_uses($this->argument)));
    }

    /**
     * Test All
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\AllArgument
     */
    public function testAll()
    {
        $this->argument->all();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'all'));
    }

    /**
     * Test All False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\AllArgument
     */
    public function testAllFalse()
    {
        $this->argument->all()->all();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'all'));
    }

    /**
     * Test the getAll method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\AllArgument
     */
    public function testGetAll()
    {
        $expected = ' --all';
        $result = $this->argument->all()->getAll();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getAll method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\AllArgument
     */
    public function testGetAllReturnsEmptyString()
    {
        $result = $this->argument->getAll();
        $this->assertEmpty($result);
    }

}
