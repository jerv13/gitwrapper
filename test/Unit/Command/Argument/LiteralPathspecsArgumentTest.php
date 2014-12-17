<?php
/**
 * Test for the LiteralPathspecs argument
 *
 * This file contains test for the LiteralPathspecs argument
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
 * Test for the LiteralPathspecs argument
 *
 * Test for the LiteralPathspecs argument
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

class LiteralPathspecsArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\LiteralPathspecsArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\LiteralPathspecsArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\LiteralPathspecsArgument', class_uses($this->argument)));
    }

    /**
     * Test LiteralPathspecs
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LiteralPathspecsArgument
     */
    public function testLiteralPathspecs()
    {
        $this->argument->literalPathspecs();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'literalPathspecs'));
    }

    /**
     * Test LiteralPathspecs False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LiteralPathspecsArgument
     */
    public function testLiteralPathspecsFalse()
    {
        $this->argument->literalPathspecs()->literalPathspecs();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'literalPathspecs'));
    }
    
    /**
     * Test the getLiteralPathspecs method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LiteralPathspecsArgument
     */
    public function testGetLiteralPathspecs()
    {
        $expected = ' --literal-pathspecs';
        $result = $this->argument->literalPathspecs()->getLiteralPathspecs();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getLiteralPathspecs method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LiteralPathspecsArgument
     */
    public function testGetLiteralPathspecsReturnsEmptyString()
    {
        $result = $this->argument->getLiteralPathspecs();
        $this->assertEmpty($result);
    }

}
