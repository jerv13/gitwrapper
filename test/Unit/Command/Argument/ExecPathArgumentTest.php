<?php
/**
 * Test for the ExecPath argument
 *
 * This file contains test for the ExecPath argument
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

use Reliv\GitTest\Unit\Command\Base;

require_once __DIR__ . '/../Base.php';


/**
 * Test for the ExecPath argument
 *
 * Test for the ExecPath argument
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

class ExecPathArgumentTest extends Base
{
    /** @var \Reliv\Git\Command\Argument\ExecPathArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ExecPathArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ExecPathArgument', class_uses($this->argument)));
        $this->initTempDir();
    }

    /**
     * Test ExecutablePath
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ExecPathArgument
     */
    public function testExecutablePath()
    {
        $config = $this->getConfig();

        $this->argument->execPath($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'execPath')
        );
    }

    /**
     * Test ExecutablePath Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ExecPathArgument
     */
    public function testExecutablePathEmptyString()
    {
        $config = $this->getConfig();

        $this->argument->execPath($config['tempFolder'])->execPath('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'execPath'));
    }

    /**
     * Test ExecutablePath False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ExecPathArgument
     */
    public function testExecutablePathFalse()
    {
        $config = $this->getConfig();

        $this->argument->execPath($config['tempFolder'])->execPath(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'execPath'));
    }

    /**
     * Test ExecutablePath Invalid Parameter
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ExecPathArgument
     * @expectedException \Reliv\Git\Exception\DirectoryNotFoundException
     */
    public function testExecutablePathInvalid()
    {
        $this->argument->execPath('/not-a-folder-for-git');
    }

    /**
     * Test the getExecPath method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ExecPathArgument
     */
    public function testGetExecPath()
    {
        $config = $this->getConfig();
        $tmpFolder = $config['tempFolder'];
        $expected = ' --exec-path='.escapeshellarg($tmpFolder);
        $result = $this->argument->execPath($tmpFolder)->getExecPath();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getExecPath method Null
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ExecPathArgument
     */
    public function testGetExecPathNull()
    {
        $expected = ' --exec-path';
        $result = $this->argument->execPath()->getExecPath();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getExecPath method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ExecPathArgument
     */
    public function testGetExecPathReturnsEmptyString()
    {
        $result = $this->argument->getExecPath();
        $this->assertEmpty($result);
    }

}
