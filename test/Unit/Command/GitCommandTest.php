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

require_once __DIR__ . '/Base.php';

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

class GitTest extends Base
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
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'workTree')
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
    public function testStatusWithPathspecs()
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
     * Test GitDir
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testGitDir()
    {
        $config = $this->getConfig();

        $this->command->gitDir($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'gitDir')
        );
    }

    /**
     * Test GitDir Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testGitDirEmptyString()
    {
        $config = $this->getConfig();

        $this->command->gitDir($config['tempFolder'])->gitDir('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'gitDir'));
    }

    /**
     * Test GitDir Invalid Parameter
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     * @expectedException \Reliv\Git\Exception\DirectoryNotFoundException
     */
    public function testGitDirInvalid()
    {
        $this->command->gitDir('/not-a-folder-for-git');
    }

    /*
     *  workTree Property
     */

    /**
     * Test WorkTree
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testWorkTree()
    {
        $config = $this->getConfig();

        $this->command->workTree($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'workTree')
        );
    }

    /**
     * Test WorkTree Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testWorkTreeEmptyString()
    {
        $config = $this->getConfig();

        $this->command->workTree($config['tempFolder'])->workTree('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'workTree'));
    }

    /**
     * Test WorkTree Invalid Parameter
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     * @expectedException \Reliv\Git\Exception\DirectoryNotFoundException
     */
    public function testWorkTreeInvalid()
    {
        $this->command->workTree('/not-a-folder-for-git');
    }

    /*
     *  Namespace Property
     */

    /**
     * Test setNamespace
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testSetNamespace()
    {
        $namespace = 'someNameSpace';

        $this->command->setNamespace($namespace);
        $this->assertEquals(
            $namespace,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'namespace')
        );
    }

    /**
     * Test setNamespace False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testSetNamespaceEmpty()
    {
        $this->command->setNamespace('someNamespace')->setNamespace(false);
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'namespace'));
    }

    /**
     * Test setNamespace Invalid Parameter
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testSetNamespaceInvalid()
    {
        $this->command->setNamespace(array('invalid'));
    }

    /*
     *  Bare Property
     */

    /**
     * Test Bare
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testBare()
    {
        $this->command->bare();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'bare'));
    }

    /**
     * Test Bare False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testBareFalse()
    {
        $this->command->bare()->bare();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'bare'));
    }

    /*
     *  NoReplaceObjects Property
     */

    /**
     * Test NoReplaceObjects
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testNoReplaceObjects()
    {
        $this->command->noReplaceObjects();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noReplaceObjects'));
    }

    /**
     * Test NoReplaceObjects False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testNoReplaceObjectsFalse()
    {
        $this->command->noReplaceObjects()->noReplaceObjects();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noReplaceObjects'));
    }

    /*
     *  LiteralPathspecs Property
     */

    /**
     * Test LiteralPathspecs
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testLiteralPathspecs()
    {
        $this->command->literalPathspecs();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'literalPathspecs'));
    }

    /**
     * Test LiteralPathspecs False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testLiteralPathspecsFalse()
    {
        $this->command->literalPathspecs()->literalPathspecs();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'literalPathspecs'));
    }


    /*
     *  GlobPathspecs Property
     */

    /**
     * Test GlobPathspecs
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testGlobPathspecs()
    {
        $this->command->globPathspecs();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'globPathspecs'));
    }

    /**
     * Test GlobPathspecs False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testGlobPathspecsFalse()
    {
        $this->command->globPathspecs()->globPathspecs();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'globPathspecs'));
    }

    /*
     *  NoGlobPathspecs Property
     */

    /**
     * Test NoGlobPathspecs
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testNoGlobPathspecs()
    {
        $this->command->noGlobPathspecs();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noGlobPathspecs'));
    }

    /**
     * Test NoGlobPathspecs False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testNoGlobPathspecsFalse()
    {
        $this->command->noGlobPathspecs()->noGlobPathspecs();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noGlobPathspecs'));
    }

    /*
     *  ICasePathspecs Property
     */

    /**
     * Test ICasePathspecs
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testICasePathspecs()
    {
        $this->command->iCasePathspecs();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'iCasePathspecs'));
    }

    /**
     * Test ICasePathspecs False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testICasePathspecsFalse()
    {
        $this->command->iCasePathspecs()->iCasePathspecs();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'iCasePathspecs'));
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
            .' --noglob-pathspecs'
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
            ->noGlobPathspecs()
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
}
