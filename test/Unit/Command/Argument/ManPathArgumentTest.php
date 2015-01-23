<?php
/**
 * Test for the ManPath argument
 *
 * This file contains test for the ManPath argument
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
 * Test for the ManPath argument
 *
 * Test for the ManPath argument
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

class ManPathArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\ManPathArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ManPathArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ManPathArgument', class_uses($this->argument)));
    }

    /**
     * Test ManPath
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ManPathArgument
     */
    public function testManPath()
    {
        $this->argument->manPath();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'manPath'));
    }

    /**
     * Test ManPath False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ManPathArgument
     */
    public function testManPathFalse()
    {
        $this->argument->manPath()->manPath();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'manPath'));
    }


    /**
     * Test the getManPath method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ManPathArgument
     */
    public function testGetManPath()
    {
        $expected = ' --man-path';
        $result = $this->argument->manPath()->getManPath();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getManPath method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ManPathArgument
     */
    public function testGetManPathReturnsEmptyString()
    {
        $result = $this->argument->getManPath();
        $this->assertEmpty($result);
    }
}
