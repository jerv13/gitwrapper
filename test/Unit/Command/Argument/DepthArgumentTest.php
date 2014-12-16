<?php
/**
 * Test for the Depth argument
 *
 * This file contains test for the Depth argument
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
 * Test for the Depth argument
 *
 * Test for the Depth argument
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

class DepthArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\DepthArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\DepthArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\DepthArgument', class_uses($this->argument)));
    }

    /**
     * Test Depth
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DepthArgument
     */
    public function testDepth()
    {
        $expected = 5;

        $this->argument->depth($expected);
        $this->assertEquals(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'depth')
        );
    }

    /**
     * Test Depth Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DepthArgument
     */
    public function testDepthEmpty()
    {
        $this->argument->depth('');
        $this->assertNull(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'depth'));
    }

    /**
     * Test Depth Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DepthArgument
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testDepthInvalid()
    {
        $this->argument->depth('invalid');
    }

    /**
     * Test the getDepth method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DepthArgument
     */
    public function testGetDepth()
    {
        $expected = ' --depth=\'5\'';
        $result = $this->argument->depth(5)->getDepth();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getDepth method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DepthArgument
     */
    public function testGetDepthReturnsEmptyString()
    {
        $result = $this->argument->getDepth();
        $this->assertEmpty($result);
    }

}
