<?php
/**
 * Test for the Status command
 *
 * This file contains test for the Status command
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

use Reliv\Git\Command\StatusCommand;

require_once __DIR__ . '/Base.php';

/**
 * Test for the Status command
 *
 * Test for the Status command
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

class StatusCommandTest extends Base
{
    /** @var \Reliv\Git\Command\StatusCommand */
    protected $command;

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof StatusCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );
    }

    /**
     * Test the constructor with pathspec
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testConstructorWithPathspec()
    {
        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $pathspec = $config['tempFolder'];

        $this->command = new StatusCommand($gitMock, $pathspec);

        $this->assertTrue($this->command instanceof StatusCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );

        $this->assertEquals(
            $pathspec,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'pathspec')
        );
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommand()
    {
        $expected = $this->config['gitPath'].' status';
        $result = $this->command->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with short display
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommandShortDisplay()
    {
        $expected = $this->config['gitPath'].' status --short';
        $result = $this->command->short()->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with long display
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommandLongDisplay()
    {
        $expected = $this->config['gitPath'].' status --long';
        $result = $this->command->long()->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with porcelain display
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommandPorcelainDisplay()
    {
        $expected = $this->config['gitPath'].' status --porcelain';
        $result = $this->command->porcelain()->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with branch option
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommandWithBranchOption()
    {
        $expected = $this->config['gitPath'].' status --branch';
        $result = $this->command->branch()->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with untracked files option
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommandWithUntrackedFilesOption()
    {
        $expected = $this->config['gitPath'].' status --untracked-files=\'no\'';
        $result = $this->command->untrackedFiles('no')->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with ignore sub-modules option
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommandWithIgnoreSubmodulesOption()
    {
        $expected = $this->config['gitPath'].' status --ignore-submodules=\'none\'';
        $result = $this->command->ignoreSubmodules('none')->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with ignored option
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommandWithIgnoredOption()
    {
        $expected = $this->config['gitPath'].' status --ignored';
        $result = $this->command->ignored()->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with z option
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommandWithZOption()
    {
        $expected = $this->config['gitPath'].' status -z';
        $result = $this->command->z()->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with no column option
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommandNoColumnOption()
    {
        $expected = $this->config['gitPath'].' status --no-column';
        $result = $this->command->noColumn()->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with column option
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommandColumnOption()
    {
        $options = array(
            'AlWays',
            'Column',
            'Dense'
        );

        $expected = $this->config['gitPath'].' status --column=\'always,column,dense\'';
        $result = $this->command->column($options)->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with pathspec
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testGetCommandWithPathspec()
    {
        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $pathspec = $config['tempFolder'];

        $this->command = new StatusCommand($gitMock, $pathspec);

        $expected = $this->config['gitPath'].' status -- \''.$pathspec.'\'';
        $result = $this->command->getCommand();
        $this->assertEquals($expected, $result);
    }
}
