<?php
/**
 * Test for the Git command
 *
 * This file contains test for the Git command
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

use Reliv\Git\Command\AddCommand;
use Reliv\Git\Command\GitCommand;
use Reliv\Git\Command\CloneCommand;
use Reliv\GitTest\Unit\UnitBase;

require_once __DIR__ . '/../UnitBase.php';

/**
 * Test for the Git command
 *
 * Test for the Git command
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

class GitTest extends UnitBase
{
    /** @var \Reliv\Git\Command\GitCommand */
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

        $this->command = new GitCommand($config['gitPath']);
    }

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof GitCommand);
    }

    /**
     * Test the constructor invalid executable
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testConstructorNotExecutable()
    {
        new GitCommand('fileNotFound');
    }

    /**
     * Test the class magic method returns expected class object.
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testCallMagicMethod()
    {
        $add = $this->command->add();
        $this->assertTrue($add instanceof AddCommand);
    }

    /**
     * Test the class magic method command not found.
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     * @expectedException \Reliv\Git\Exception\MethodNotFoundException
     */
    public function testCallMagicMethodCommandNotFound()
    {
        $this->command->notReallyHere();
    }

    /*
     * Wrapped Commands
     */

    /**
     * Test the class magic method with clone reserved word fix.
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testCallMagicMethodForClone()
    {
        $add = $this->command->clone('https://someRepo.com/repo.git', '.');
        $this->assertTrue($add instanceof CloneCommand);
    }

    /**
     * Test wrapped Init command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testInit()
    {
        $init = $this->command->init();
        $this->assertInstanceOf('\Reliv\Git\Command\InitCommand', $init);
    }

    /**
     * Test wrapped Init command with path
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testInitWithPath()
    {
        $config = $this->getConfig();
        $init = $this->command->init($config['tempFolder']);
        $this->assertInstanceOf('\Reliv\Git\Command\InitCommand', $init);

        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'runInPath')
        );
    }

    /**
     * Test wrapped Status command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testStatus()
    {
        $status = $this->command->status();
        $this->assertInstanceOf('\Reliv\Git\Command\StatusCommand', $status);
    }

    /**
     * Test wrapped Status command with path
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testStatusWithPathSpecs()
    {
        $config = $this->getConfig();
        $status = $this->command->status($config['tempFolder']);
        $this->assertInstanceOf('\Reliv\Git\Command\StatusCommand', $status);

        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($status, 'pathspec')
        );
    }

    /**
     * Test wrapped Fetch command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testFetch()
    {
        $fetch = $this->command->fetch();
        $this->assertInstanceOf('\Reliv\Git\Command\FetchCommand', $fetch);
    }

    /**
     * Test wrapped Fetch Command with Repo and Refspec
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testFetchWithRepoAndRefspec()
    {
        $fetch = $this->command->fetch('myRepo', 'refs/heads/*:refs/remotes/origin/*');
        $this->assertInstanceOf('\Reliv\Git\Command\FetchCommand', $fetch);

        $this->assertEquals(
            'myRepo',
            \PHPUnit_Framework_Assert::readAttribute($fetch, 'repositoryOrGroup')
        );

        $this->assertEquals(
            'refs/heads/*:refs/remotes/origin/*',
            \PHPUnit_Framework_Assert::readAttribute($fetch, 'refspec')
        );
    }

    /**
     * Test wrapped ls-remote command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testLsRemote()
    {
        $init = $this->command->lsRemote();
        $this->assertInstanceOf('\Reliv\Git\Command\LsRemoteCommand', $init);
    }

    /**
     * Test wrapped ls-remote command with params
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testLsRemoteWithParams()
    {
        $repo = 'https://someRepo.com/repo.git';
        $refs = 'remotes/upstream';

        $lsRemote = $this->command->lsRemote($repo, $refs);
        $this->assertInstanceOf('\Reliv\Git\Command\LsRemoteCommand', $lsRemote);

        $this->assertEquals(
            $repo,
            \PHPUnit_Framework_Assert::readAttribute($lsRemote, 'repository')
        );

        $this->assertEquals(
            $refs,
            \PHPUnit_Framework_Assert::readAttribute($lsRemote, 'refs')
        );
    }

    /**
     * Test wrapped ls-remote command with params
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testCheckout()
    {
        $branch = 'origin/master';

        $checkout = $this->command->checkout($branch);
        $this->assertInstanceOf('\Reliv\Git\Command\CheckoutCommand', $checkout);

        $this->assertEquals(
            $branch,
            \PHPUnit_Framework_Assert::readAttribute($checkout, 'branchOrCommit')
        );
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testGetCommand()
    {
        $config = $this->getConfig();
        $expected = $config['gitPath'];
        $result = $this->command->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testGetCommandAllParameters()
    {
        $config = $this->getConfig();
        $gitPath = $config['gitPath'];
        $tmpFolder = $config['tempFolder'];

        $configOptions = array(
            'core.editor' => 'nano',
            'color.ui' => false
        );

        $expected = $gitPath
            .' --version'
            .' --help'
            .' -C '.escapeshellarg($tmpFolder)
            .' -c \'core.editor\'=\'nano\''
            .' -c \'color.ui\'=\'false\''
            .' --exec-path='.escapeshellarg($tmpFolder)
            .' --html-path'
            .' --man-path'
            .' --info-path'
            .' --paginate'
            .' --git-dir='.escapeshellarg($tmpFolder)
            .' --work-tree='.escapeshellarg($tmpFolder)
            .' --namespace='.escapeshellarg('MyNameSpace')
            .' --bare'
            .' --no-replace-objects'
            .' --literal-pathspecs'
            .' --glob-pathspecs'
            .' --icase-pathspecs';

        $result = $this->command
            ->version()
            ->help()
            ->runInPath($tmpFolder)
            ->c($configOptions)
            ->execPath($tmpFolder)
            ->htmlPath()
            ->manPath()
            ->infoPath()
            ->paginate()
            ->gitDir($tmpFolder)
            ->workTree($tmpFolder)
            ->setNamespace('MyNameSpace')
            ->bare()
            ->noReplaceObjects()
            ->literalPathspecs()
            ->globPathspecs()
            ->iCasePathspecs()
            ->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testGetCommandWithExecutablePathNull()
    {
        $config = $this->getConfig();
        $gitPath = $config['gitPath'];

        $expected = $gitPath.' --exec-path';

        $result = $this->command->execPath(null)->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with no pager
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testGetCommandWithNoPager()
    {
        $config = $this->getConfig();
        $gitPath = $config['gitPath'];

        $expected = $gitPath.' --no-pager';

        $result = $this->command
            ->noPager()
            ->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with no pager
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testGetCommandWithNoGlobPathSpecs()
    {
        $config = $this->getConfig();
        $gitPath = $config['gitPath'];

        $expected = $gitPath.' --noglob-pathspecs';

        $result = $this->command
            ->noGlobPathspecs()
            ->getCommand();

        $this->assertEquals($expected, $result);
    }
}
