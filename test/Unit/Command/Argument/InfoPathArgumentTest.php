<?php
/**
 * Test for the InfoPath argument
 *
 * This file contains test for the InfoPath argument
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
 * Test for the InfoPath argument
 *
 * Test for the InfoPath argument
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

class InfoPathArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\InfoPathArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\InfoPathArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\InfoPathArgument', class_uses($this->argument)));
    }

    /**
     * Test InfoPath
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\InfoPathArgument
     */
    public function testInfoPath()
    {
        $this->argument->infoPath();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'infoPath'));
    }

    /**
     * Test InfoPath False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\InfoPathArgument
     */
    public function testInfoPathFalse()
    {
        $this->argument->infoPath()->infoPath();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'infoPath'));
    }


    /**
     * Test the getInfoPath method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\InfoPathArgument
     */
    public function testGetInfoPath()
    {
        $expected = ' --info-path';
        $result = $this->argument->infoPath()->getInfoPath();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getInfoPath method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\InfoPathArgument
     */
    public function testGetInfoPathReturnsEmptyString()
    {
        $result = $this->argument->getInfoPath();
        $this->assertEmpty($result);
    }
}
