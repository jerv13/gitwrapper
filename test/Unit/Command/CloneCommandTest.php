<?php
/**
 * Test for the GitClone command
 *
 * This file contains test for the GitClone command
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

use Reliv\Git\Command\CloneCommand;
use Reliv\GitTest\Unit\UnitBase;

require_once __DIR__ . '/../UnitBase.php';

/**
 * Test for the GitClone command
 *
 * Test for the GitClone command
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

class CloneCommandTest extends UnitBase
{
    /** @var \Reliv\Git\Command\CloneCommand */
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

        $this->command = new CloneCommand($gitMock, $config['tempFolder']);
    }

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\CloneCommand
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof CloneCommand);
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
     * @covers \Reliv\Git\Command\CloneCommand
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

        $this->command = new CloneCommand($gitMock, array());
    }


    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\CloneCommand
     */
    public function testGetCommand()
    {
        $config = $this->getConfig();

        $expected = $config['gitPath']
            .' clone'
            .' '.escapeshellarg($config['tempFolder']);

        $result = $this->command->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\CloneCommand
     */
    public function testGetCommandAllOptionsMinusNoSingleBranch()
    {
        $config = $this->getConfig();
        $someNameSetter = 'someName';

        $fakeConfig = array(
            'pushUpdateRejected' => 'false',
            'color.ui' => 'always'
        );

        $this->delTree($config['tempFolder'].'/1');
        $this->delTree($config['tempFolder'].'/2');
        $this->delTree($config['tempFolder'].'/3');
        mkdir($config['tempFolder'].'/1', 0777, true);
        mkdir($config['tempFolder'].'/2', 0777, true);

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new CloneCommand($gitMock, $config['tempFolder'], '.');

        $expected = $this->config['gitPath']
            .' clone'
            .' --local'
            .' --no-hardlinks'
            .' --shared'
            .' --reference='.escapeshellarg($someNameSetter)
            .' --quiet'
            .' --verbose'
            .' --progress'
            .' --no-checkout'
            .' --bare'
            .' --mirror'
            .' --origin='.escapeshellarg($someNameSetter.'1')
            .' --branch='.escapeshellarg($someNameSetter.'2')
            .' --upload-pack='.escapeshellarg($someNameSetter.'3')
            .' --template='.escapeshellarg($config['tempFolder'].'/1')
            .' --config \'pushUpdateRejected\'=\'false\''
            .' --config \'color.ui\'=\'always\''
            .' --depth=\'5\''
            .' --single-branch'
            .' --recursive'
            .' --separate-git-dir='.escapeshellarg($config['tempFolder'].'/2')
            .' '.escapeshellarg($config['tempFolder'])
            .' \'.\'';

        $result = $this->command
            ->local()
            ->noHardLinks()
            ->shared()
            ->reference($someNameSetter)
            ->quiet()
            ->verbose()
            ->progress()
            ->noCheckout()
            ->bare()
            ->mirror()
            ->origin($someNameSetter.'1')
            ->branch($someNameSetter.'2')
            ->uploadPack($someNameSetter.'3')
            ->template($config['tempFolder'].'/1')
            ->config($fakeConfig)
            ->depth(5)
            ->singleBranch()
            ->recursive()
            ->separateGitDir($config['tempFolder'].'/2')
            ->getCommand();

        $this->assertEquals($expected, $result);

        $this->delTree($config['tempFolder'].'1');
        $this->delTree($config['tempFolder'].'2');
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\CloneCommand
     */
    public function testGetCommandWithNoSingleBranch()
    {
        $config = $this->getConfig();

        $expected = $this->config['gitPath']
            .' clone'
            .' --no-single-branch'
            .' '.escapeshellarg($config['tempFolder']);

        $result = $this->command
            ->noSingleBranch()
            ->getCommand();

        $this->assertEquals($expected, $result);
    }
}
