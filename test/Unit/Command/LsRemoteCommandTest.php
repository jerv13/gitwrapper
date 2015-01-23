<?php
/**
 * Test for the LsRemote command
 *
 * This file contains test for the LsRemote command
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

namespace Reliv\GitTest\Unit\Command;

use Reliv\Git\Command\LsRemoteCommand;

require_once __DIR__ . '/../Base.php';

/**
 * Test for the LsRemote command
 *
 * Test for the LsRemote command
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

class LsRemoteCommandTest extends Base
{
    /** @var \Reliv\Git\Command\LsRemoteCommand */
    protected $command;

    /**
     * Setup for tests
     *
     * @return void
     */
    public function setup()
    {
        $config = $this->getConfig();
        $this->initTempDir();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new LsRemoteCommand($gitMock, $config['tempFolder'], 'HEAD');
    }

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\LsRemoteCommand
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof LsRemoteCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );
    }

    /**
     * Test the constructor missing arguments
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\LsRemoteCommand
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testConstructorWithMissingArguments()
    {
        $config = $this->getConfig();
        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new LsRemoteCommand($gitMock, array());
    }

    /**
     * Test the constructor missing refs
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\LsRemoteCommand
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testConstructorWithMissingRefs()
    {
        $config = $this->getConfig();
        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new LsRemoteCommand($gitMock, $config['tempFolder'], array());
    }


    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\LsRemoteCommand
     */
    public function testGetCommand()
    {
        $config = $this->getConfig();

        $expected = $config['gitPath']
            .' ls-remote'
            .' '.escapeshellarg($config['tempFolder'])
            .' '.escapeshellarg('HEAD');

        $result = $this->command->getCommand();
        $this->assertEquals($expected, $result);
    }
}
