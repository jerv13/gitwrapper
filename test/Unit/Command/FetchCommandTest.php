<?php
/**
 * Test for the Fetch command
 *
 * This file contains test for the Fetch command
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

use Reliv\Git\Command\FetchCommand;

require_once __DIR__ . '/../Base.php';

/**
 * Test for the Fetch command
 *
 * Test for the Fetch command
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

class FetchCommandTest extends Base
{
    /** @var \Reliv\Git\Command\FetchCommand */
    protected $command;

    /**
     * Setup for tests
     *
     * @return void
     */
    public function setup()
    {
        parent::setup();

        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new FetchCommand($gitMock);
    }

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\FetchCommand
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof FetchCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );
    }

    /**
     * Test the constructor with a group name
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\FetchCommand
     */
    public function testConstructorWithGroup()
    {
        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new FetchCommand($gitMock, 'myGroup');

        $this->assertTrue($this->command instanceof FetchCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );

        $this->assertEquals(
            'myGroup',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'repositoryOrGroup')
        );
    }

    /**
     * Test the constructor with a repository and refspec
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\FetchCommand
     */
    public function testConstructorWithRepoAndRefspec()
    {
        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new FetchCommand($gitMock, 'myRepo', 'refs/heads/*:refs/remotes/origin/*');

        $this->assertTrue($this->command instanceof FetchCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );

        $this->assertEquals(
            'myRepo',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'repositoryOrGroup')
        );

        $this->assertEquals(
            'refs/heads/*:refs/remotes/origin/*',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'refspec')
        );
    }


    /**
     * Test the constructor with refspec but no repository
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\FetchCommand
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testConstructorWithRefspecButNoRepo()
    {
        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new FetchCommand($gitMock, null, 'refs/heads/*:refs/remotes/origin/*');
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\FetchCommand
     */
    public function testGetCommand()
    {
        $expected = $this->config['gitPath'].' fetch';
        $result = $this->command->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\FetchCommand
     */
    public function testGetCommandWithGroup()
    {
        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new FetchCommand($gitMock, 'myGroup');

        $this->assertTrue($this->command instanceof FetchCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );

        $this->assertEquals(
            'myGroup',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'repositoryOrGroup')
        );

        $expected = $this->config['gitPath'].' fetch \'myGroup\'';
        $result = $this->command->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\FetchCommand
     */
    public function testGetCommandWithRepoAndRefspec()
    {
        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new FetchCommand($gitMock, 'myRepo', 'refs/heads/*:refs/remotes/origin/*');

        $this->assertTrue($this->command instanceof FetchCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );

        $this->assertEquals(
            'myRepo',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'repositoryOrGroup')
        );

        $this->assertEquals(
            'refs/heads/*:refs/remotes/origin/*',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'refspec')
        );

        $expected = $this->config['gitPath'].' fetch \'myRepo\' \'refs/heads/*:refs/remotes/origin/*\'';
        $result = $this->command->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\FetchCommand
     */
    public function testGetCommandWithArguments()
    {

        $expected = $this->config['gitPath'].' fetch'
            .' --all'
            .' --append'
            .' --depth=\'5\''
            .' --unshallow'
            .' --update-shallow'
            .' --dry-run'
            .' --force'
            .' --keep'
            .' --prune'
            .' --no-tags'
            .' --refmap=\'refs/heads/*:refs/remotes/origin/*\''
            .' --recurse-submodules=\'no\''
            .' --upload-pack=\'someExecPath\''
            .' --quiet'
            .' --verbose'
            .' --progress';


        $result = $this->command
            ->all()
            ->append()
            ->depth(5)
            ->unshallow()
            ->updateShallow()
            ->dryRun()
            ->force()
            ->keep()
            ->prune()
            ->noTags()
            ->refMap('refs/heads/*:refs/remotes/origin/*')
            ->recurseSubmodules(false)
            ->uploadPack('someExecPath')
            ->quiet()
            ->verbose()
            ->progress()
            ->getCommand();

        $this->assertEquals($expected, $result);
    }
}
