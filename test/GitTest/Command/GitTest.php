<?php
/**
 * Test for the Git command
 *
 * This file contains test for the Git command
 *
 * PHP version 5.3
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

namespace GitTest\Command;

use Git\Command\Add;
use Git\Command\Git;
use Git\Command\GitClone;

require_once __DIR__ . '/Base.php';

/**
 * Test for the Git command
 *
 * Test for the Git command
 *
 * PHP version 5.3
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
    /** @var \Git\Command\Git */
    protected $command;

    /**
     * Setup for tests
     *
     * @return void
     */
    public function setup()
    {
        $config = $this->getConfig();

        $this->command = new Git($config['gitPath']);
    }

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof Git);
    }

    /**
     * Test the constructor invalid executable
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testConstructorNotExecutable()
    {
        $test = new Git('fileNotFound');
    }

    /**
     * Test the class default values
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testDefaults()
    {
        $defaults = array(
            'version'          => false,
            'help'             => false,
            'runInPath'        => '',
            'c'                => array(),
            'executablePath'   => false,
            'htmlPath'         => false,
            'manPath'          => false,
            'infoPath'         => false,
            'paginate'         => false,
            'noPager'            => false,
            'gitDir'           => '',
            'workTree'         => '',
            'namespace'        => '',
            'bare'             => false,
            'noReplaceObjects' => false,
            'literalPathspecs' => false,
            'globPathspecs'    => false,
            'noGlobPathspecs'  => false,
            'iCasePathspecs'   => false,
        );

        $this->defaultTester($this->command, $defaults);
    }

    /**
     * Test the class magic method returns expected class object.
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testCallMagicMethod()
    {
        $add = $this->command->add();
        $this->assertTrue($add instanceof Add);
    }

    /**
     * Test the class magic method with clone reserved word fix.
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testCallMagicMethodForClone()
    {
        $add = $this->command->clone();
        $this->assertTrue($add instanceof GitClone);
    }

    /**
     * Test the class magic method command not found.
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\MethodNotFoundException
     */
    public function testCallMagicMethodCommandNotFound()
    {
        $this->command->notReallyHere();
    }

    /*
     *  Version Property
     */

    /**
     * Test Version
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testVersion()
    {
        $this->command->version();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'version'));
    }

    /**
     * Test Version False
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testVersionFalse()
    {
        $this->command->version()->version(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'version'));
    }

    /**
     * Test Version Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testVersionInvalid()
    {
        $this->command->version('invalid');
    }

    /*
     *  Help Property
     */

    /**
     * Test Help
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testHelp()
    {
        $this->command->help();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'help'));
    }

    /**
     * Test Help False
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testHelpFalse()
    {
        $this->command->help()->help(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'help'));
    }

    /**
     * Test Help Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testHelpInvalid()
    {
        $this->command->help('help');
    }

    /*
     *  runInPath Property
     */

    /**
     * Test RunInPath
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testRunInPath()
    {
        $config = $this->getConfig();

        $this->command->runInPath($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'runInPath')
        );
    }

    /**
     * Test RunInPath Empty
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testRunInPathEmptyString()
    {
        $config = $this->getConfig();

        $this->command->runInPath($config['tempFolder'])->runInPath('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'runInPath'));
    }

    /**
     * Test RunInPath Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\DirectoryNotFoundException
     */
    public function testRunInPathInvalid()
    {
        $this->command->runInPath('/not-a-folder-for-git');
    }


    /*
     *  c Property
     */

    /**
     * Test C
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testC()
    {
        $expected = array(
            'color.ui' => false,
            'format.pretty' => 'oneline'
        );

        $this->command->c($expected);
        $this->assertEquals(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'c')
        );
    }

    /**
     * Test C Empty Array
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testCEmptyArray()
    {
        $expected = array();

        $this->command->c($expected);
        $this->assertEquals(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'c')
        );
    }

    /**
     * Test C Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testCInvalid()
    {
        $this->command->c('not-valid');
    }


    /*
     *  ExecutablePath Property
     */

    /**
     * Test ExecutablePath
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testExecutablePath()
    {
        $config = $this->getConfig();

        $this->command->executablePath($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'executablePath')
        );
    }

    /**
     * Test ExecutablePath Empty
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testExecutablePathEmptyString()
    {
        $config = $this->getConfig();

        $this->command->executablePath($config['tempFolder'])->executablePath('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'executablePath'));
    }

    /**
     * Test ExecutablePath False
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testExecutablePathFalse()
    {
        $config = $this->getConfig();

        $this->command->executablePath($config['tempFolder'])->executablePath(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'executablePath'));
    }

    /**
     * Test ExecutablePath Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\DirectoryNotFoundException
     */
    public function testExecutablePathInvalid()
    {
        $this->command->executablePath('/not-a-folder-for-git');
    }

    /*
     *  HtmlPath Property
     */

    /**
     * Test HtmlPath
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testHtmlPath()
    {
        $this->command->htmlPath();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'htmlPath'));
    }

    /**
     * Test HtmlPath False
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testHtmlPathFalse()
    {
        $this->command->htmlPath()->htmlPath(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'htmlPath'));
    }

    /**
     * Test HtmlPath Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testHtmlPathInvalid()
    {
        $this->command->htmlPath('invalid');
    }

    /*
     *  ManPath Property
     */

    /**
     * Test ManPath
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testManPath()
    {
        $this->command->manPath();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'manPath'));
    }

    /**
     * Test ManPath False
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testManPathFalse()
    {
        $this->command->manPath()->manPath(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'manPath'));
    }

    /**
     * Test ManPath Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testManPathInvalid()
    {
        $this->command->manPath('invalid');
    }

    /*
     *  InfoPath Property
     */

    /**
     * Test InfoPath
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testInfoPath()
    {
        $this->command->infoPath();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'infoPath'));
    }

    /**
     * Test InfoPath False
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testInfoPathFalse()
    {
        $this->command->infoPath()->infoPath(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'infoPath'));
    }

    /**
     * Test InfoPath Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testInfoPathInvalid()
    {
        $this->command->infoPath('invalid');
    }

    /*
     *  Paginate Property
     */

    /**
     * Test Paginate
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testPaginate()
    {
        $this->command->paginate();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'paginate'));
    }

    /**
     * Test Paginate False
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testPaginateFalse()
    {
        $this->command->paginate()->paginate(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'paginate'));
    }

    /**
     * Test Paginate Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testPaginateInvalid()
    {
        $this->command->paginate('invalid');
    }

    /*
     *  NoPager Property
     */

    /**
     * Test NoPager
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testNoPager()
    {
        $this->command->noPager();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noPager'));
    }

    /**
     * Test NoPager False
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testNoPagerFalse()
    {
        $this->command->noPager()->noPager(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noPager'));
    }

    /**
     * Test NoPager Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testNoPagerInvalid()
    {
        $this->command->noPager('invalid');
    }


    /*
     *  GitDir Property
     */

    /**
     * Test GitDir
     *
     * @return void
     *
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\DirectoryNotFoundException
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
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\DirectoryNotFoundException
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
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
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
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
     */
    public function testBareFalse()
    {
        $this->command->bare()->bare(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'bare'));
    }

    /**
     * Test Bare Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testBareInvalid()
    {
        $this->command->bare('invalid');
    }

    /*
     *  NoReplaceObjects Property
     */

    /**
     * Test NoReplaceObjects
     *
     * @return void
     *
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
     */
    public function testNoReplaceObjectsFalse()
    {
        $this->command->noReplaceObjects()->noReplaceObjects(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noReplaceObjects'));
    }

    /**
     * Test NoReplaceObjects Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testNoReplaceObjectsInvalid()
    {
        $this->command->noReplaceObjects('invalid');
    }

    /*
     *  LiteralPathspecs Property
     */

    /**
     * Test LiteralPathspecs
     *
     * @return void
     *
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
     */
    public function testLiteralPathspecsFalse()
    {
        $this->command->literalPathspecs()->literalPathspecs(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'literalPathspecs'));
    }

    /**
     * Test LiteralPathspecs Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testLiteralPathspecsInvalid()
    {
        $this->command->literalPathspecs('invalid');
    }

    /*
     *  GlobPathspecs Property
     */

    /**
     * Test GlobPathspecs
     *
     * @return void
     *
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
     */
    public function testGlobPathspecsFalse()
    {
        $this->command->globPathspecs()->globPathspecs(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'globPathspecs'));
    }

    /**
     * Test GlobPathspecs Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testGlobPathspecsInvalid()
    {
        $this->command->globPathspecs('invalid');
    }

    /*
     *  NoGlobPathspecs Property
     */

    /**
     * Test NoGlobPathspecs
     *
     * @return void
     *
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
     */
    public function testNoGlobPathspecsFalse()
    {
        $this->command->noGlobPathspecs()->noGlobPathspecs(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noGlobPathspecs'));
    }

    /**
     * Test NoGlobPathspecs Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testNoGlobPathspecsInvalid()
    {
        $this->command->noGlobPathspecs('invalid');
    }

    /*
     *  ICasePathspecs Property
     */

    /**
     * Test ICasePathspecs
     *
     * @return void
     *
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
     */
    public function testICasePathspecsFalse()
    {
        $this->command->iCasePathspecs()->iCasePathspecs(false);
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'iCasePathspecs'));
    }

    /**
     * Test ICasePathspecs Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\Git
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testICasePathspecsInvalid()
    {
        $this->command->iCasePathspecs('invalid');
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Git\Command\Git
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
     * @covers \Git\Command\Git
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
            .' --no-pager'
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
            ->executablePath($tmpFolder)
            ->htmlPath()
            ->manPath()
            ->infoPath()
            ->paginate()
            ->noPager()
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
     * @covers \Git\Command\Git
     */
    public function testExecutablePathNull()
    {
        $config = $this->getConfig();
        $gitPath = $config['gitPath'];
        $tmpFolder = $config['tempFolder'];

        $expected = $gitPath.' --exec-path';

        $result = $this->command->executablePath(null)->getCommand();

        $this->assertEquals($expected, $result);
    }

    /**
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Git\Command\CommandAbstract
     */
    public function testExecute()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
