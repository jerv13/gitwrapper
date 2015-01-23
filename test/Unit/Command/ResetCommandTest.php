<?php
/**
 * Test for the Reset command
 *
 * This file contains test for the Reset command
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

use Reliv\Git\Command\ResetCommand;
use Reliv\GitTest\Unit\UnitBase;

require_once __DIR__ . '/../UnitBase.php';

/**
 * Test for the Reset command
 *
 * Test for the Reset command
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

class ResetCommandTest extends UnitBase
{
    /** @var \Reliv\Git\Command\ResetCommand */
    protected $command;

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof ResetCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );
    }

    /**
     * Test the constructor params
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testConstructorWithParams()
    {
        $commit = 'c0a293f3ac0db30d0c942ccfe5303026fd4fcf6a';
        $paths = '/somePath';

        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new ResetCommand($gitMock, $commit, $paths);

        $this->assertTrue($this->command instanceof ResetCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );

        $this->assertEquals(
            $commit,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'treeishOrCommit')
        );

        $this->assertEquals(
            $paths,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'paths')
        );
    }

    /**
     * Test Soft
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testSoft()
    {
        $this->command->soft();
        $this->assertEquals(
            'soft',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'mode')
        );
    }

    /**
     * Test Mixed
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testMixed()
    {
        $this->command->mixed();
        $this->assertEquals(
            'mixed',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'mode')
        );
    }

    /**
     * Test Hard
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testHard()
    {
        $this->command->hard();
        $this->assertEquals(
            'hard',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'mode')
        );
    }

    /**
     * Test Merge
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testMerge()
    {
        $this->command->merge();
        $this->assertEquals(
            'merge',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'mode')
        );
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testGetCommand()
    {
        $config = $this->getConfig();
        $expected = $this->config['gitPath'].' reset';
        $result = $this->command->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command soft reset
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testGetCommandSoft()
    {
        $config = $this->getConfig();
        $expected = $this->config['gitPath'].' reset --soft';
        $result = $this->command->soft()->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command mixed reset
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testGetCommandMixed()
    {
        $config = $this->getConfig();
        $expected = $config['gitPath'].' reset --mixed';
        $result = $this->command->mixed()->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command hard reset
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testGetCommandHard()
    {
        $config = $this->getConfig();
        $expected = $config['gitPath'].' reset --hard';
        $result = $this->command->hard()->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command hard reset
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testGetCommandMerge()
    {
        $config = $this->getConfig();
        $expected = $config['gitPath'].' reset --merge';
        $result = $this->command->merge()->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command hard reset
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testGetCommandKeep()
    {
        $config = $this->getConfig();
        $expected = $config['gitPath'].' reset --keep';
        $result = $this->command->keep()->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with constructor arguments
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testGetCommandWithConstructorArguments()
    {
        $treeish = 'origin/master';
        $paths = '/somePath';

        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new ResetCommand($gitMock, $treeish, $paths);

        $this->assertTrue($this->command instanceof ResetCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );

        $this->assertEquals(
            $treeish,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'treeishOrCommit')
        );

        $this->assertEquals(
            $paths,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'paths')
        );

        $config = $this->getConfig();
        $expected = $config['gitPath'].' reset '
            .escapeshellarg($treeish)
            .' -- '.escapeshellarg($paths);

        $result = $this->command->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command traits
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\ResetCommand
     */
    public function testGetCommandTraits()
    {
        $config = $this->getConfig();
        $expected = $config['gitPath'].' reset --quiet --patch';
        $result = $this->command->quiet()->patch()->getCommand();

        $this->assertEquals($expected, $result);
    }
}
