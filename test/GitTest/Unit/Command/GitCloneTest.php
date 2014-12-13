<?php
/**
 * Test for the GitClone command
 *
 * This file contains test for the GitClone command
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

namespace GitTest\Unit\Command;

use Git\Command\GitClone;

require_once __DIR__ . '/Base.php';

/**
 * Test for the GitClone command
 *
 * Test for the GitClone command
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

class GitCloneTest extends Base
{
    /** @var \Git\Command\GitClone */
    protected $command;

    public function setup()
    {
        $config = $this->getConfig();
        $this->initTempDir();

        $gitMock = $this->getMockBuilder('\Git\Command\Git')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new GitClone($gitMock, array($config['tempFolder']));
    }

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof GitClone);
        $this->assertInstanceOf(
            '\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );
    }

    /**
     * Test the constructor missing arguments
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testConstructorWithMissingArguments()
    {
        $config = $this->getConfig();
        $gitMock = $this->getMockBuilder('\Git\Command\Git')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new GitClone($gitMock, array());
    }

    /**
     * Test the class default values
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testDefaults()
    {
        $defaults = array(
            'local'          => false,
            'noHardLinks'    => false,
            'shared'         => false,
            'reference'      => '',
            'quiet'          => false,
            'verbose'        => false,
            'progress'       => false,
            'noCheckout'     => false,
            'bare'           => false,
            'mirror'         => false,
            'origin'         => 'origin',
            'branch'         => '',
            'uploadPack'     => '',
            'template'       => '',
            'config'         => array(),
            'depth'          => null,
            'singleBranch'   => false,
            'noSingleBranch' => false,
            'recursive'      => false,
            'separateGitDir' => '',
            'toDir'          => '',
        );

        $this->defaultTester($this->command, $defaults);
    }

    /*
     *  Local Property
     */

    /**
     * Test Local
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testLocal()
    {
        $this->command->local();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'local'));
    }

    /**
     * Test Local False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testLocalFalse()
    {
        $this->command->local()->local();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'local'));
    }

    /*
     *  l Alias Property
     */

    /**
     * Test l
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testL()
    {
        $this->command->l();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'local'));
    }

    /**
     * Test L False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testLFalse()
    {
        $this->command->l()->l();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'local'));
    }

    /*
     *  NoHardLinks Property
     */

    /**
     * Test NoHardLinks
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testNoHardLinks()
    {
        $this->command->noHardLinks();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noHardLinks'));
    }

    /**
     * Test NoHardLinks False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testNoHardLinksFalse()
    {
        $this->command->noHardLinks()->noHardLinks();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noHardLinks'));
    }

    /*
     *  Shared Property
     */

    /**
     * Test Shared
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testShared()
    {
        $this->command->shared();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'shared'));
    }

    /**
     * Test Shared False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testSharedFalse()
    {
        $this->command->shared()->shared();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'shared'));
    }

    /*
     *  S Alias Property
     */

    /**
     * Test S
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testS()
    {
        $this->command->s();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'shared'));
    }

    /**
     * Test S False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testSFalse()
    {
        $this->command->s()->s();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'shared'));
    }

    /*
    *  Reference Property
    */

    /**
     * Test Reference
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testReference()
    {
        $repository = '/someFile';

        $this->command->reference($repository);
        $this->assertEquals(
            $repository,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'reference')
        );
    }

    /**
     * Test Reference False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testReferenceEmpty()
    {
        $repository = '/someFile';
        $this->command->reference($repository)->reference('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'reference'));
    }

    /*
     *  quiet Property
     */

    /**
     * Test quiet
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testQuiet()
    {
        $this->command->quiet();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'quiet'));
    }

    /**
     * Test quiet False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testQuietFalse()
    {
        $this->command->quiet()->quiet();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'quiet'));
    }

    /*
     *  Q Alias Property
     */

    /**
     * Test q
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testQ()
    {
        $this->command->q();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'quiet'));
    }

    /**
     * Test q False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testQFalse()
    {
        $this->command->q()->q();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'quiet'));
    }

    /*
     *  Verbose Property
     */

    /**
     * Test Verbose
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testVerbose()
    {
        $this->command->verbose();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'verbose'));
    }

    /**
     * Test Verbose False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testVerboseFalse()
    {
        $this->command->verbose()->verbose();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'verbose'));
    }

    /*
     *  Progress Property
     */

    /**
     * Test Progress
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testProgress()
    {
        $this->command->progress();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'progress'));
    }

    /**
     * Test Progress False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testProgressFalse()
    {
        $this->command->progress()->progress();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'progress'));
    }

    /*
     *  NoCheckout Property
     */

    /**
     * Test NoCheckout
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testNoCheckout()
    {
        $this->command->noCheckout();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noCheckout'));
    }

    /**
     * Test NoCheckout False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testNoCheckoutFalse()
    {
        $this->command->noCheckout()->noCheckout();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noCheckout'));
    }

    /*
     *  N Alias Property
     */

    /**
     * Test N Alias
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testN()
    {
        $this->command->n();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noCheckout'));
    }

    /**
     * Test N Alias False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testNFalse()
    {
        $this->command->n()->n();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noCheckout'));
    }

    /*
     *  Bare Property
     */

    /**
     * Test Bare
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
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
     * @covers \Git\Command\GitClone
     */
    public function testBareFalse()
    {
        $this->command->bare()->bare();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'bare'));
    }

    /*
     *  Mirror Property
     */

    /**
     * Test Mirror
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testMirror()
    {
        $this->command->mirror();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'mirror'));
    }

    /**
     * Test Mirror False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testMirrorFalse()
    {
        $this->command->mirror()->mirror();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'mirror'));
    }

    /*
     *  Origin Property
     */

    /**
     * Test Origin
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testOrigin()
    {
        $name = 'My New Name';

        $this->command->origin($name);
        $this->assertEquals(
            $name,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'origin')
        );
    }

    /**
     * Test Origin Empty
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testOriginEmpty()
    {
        $name = 'origin';

        $this->command->origin('');
        $this->assertEquals(
            $name,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'origin')
        );
    }

    /**
     * Test Origin Incorrect Case
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testOriginIncorrectCase()
    {
        $name = 'OrIgin';

        $this->command->origin($name);
        $this->assertEquals(
            'origin',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'origin')
        );
    }

    /*
     *  Branch Property
     */

    /**
     * Test Branch
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testBranch()
    {
        $name = 'My Branch Name';

        $this->command->branch($name);
        $this->assertEquals(
            $name,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'branch')
        );
    }

    /**
     * Test Branch Empty
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testBranchEmpty()
    {
        $name = 'My Branch Name';
        $this->command->branch($name)->branch('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'branch'));
    }

    /*
     *  UploadPack Property
     */

    /**
     * Test UploadPack
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testUploadPack()
    {
        $path = '/some/strange/path';

        $this->command->uploadPack($path);
        $this->assertEquals(
            $path,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'uploadPack')
        );
    }

    /**
     * Test UploadPack Empty
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testUploadPackEmpty()
    {
        $path = '/some/strange/path';
        $this->command->uploadPack($path)->uploadPack('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'uploadPack'));
    }

    /*
     *  U Alias Property
     */

    /**
     * Test U alias
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testU()
    {
        $path = '/some/strange/path';

        $this->command->u($path);
        $this->assertEquals(
            $path,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'uploadPack')
        );
    }

    /**
     * Test U alias Empty
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testUEmpty()
    {
        $path = '/some/strange/path';
        $this->command->u($path)->u('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'uploadPack'));
    }

    /*
     *  Template Property
     */

    /**
     * Test Template
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testTemplate()
    {
        $config = $this->getConfig();

        $this->command->template($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'template')
        );
    }

    /**
     * Test Template Empty
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testTemplateEmptyString()
    {
        $config = $this->getConfig();

        $this->command->template($config['tempFolder'])->template('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'template'));
    }

    /**
     * Test Template Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     * @expectedException \Git\Exception\DirectoryNotFoundException
     */
    public function testTemplateInvalid()
    {
        $this->command->template('/not-a-folder-for-git');
    }

    /*
     *  Config Property
     */

    /**
     * Test Config
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testConfig()
    {
        $fakeConfig = array(
            'someKey'  => 'someValue',
            'someKey2' => 'someValue2',
            'someKey3' => 'someValue3',
        );

        $this->command->config($fakeConfig);
        $this->assertEquals(
            $fakeConfig,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'config')
        );
    }

    /**
     * Test Config Not Array
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testConfigNotArray()
    {
        $fakeConfig = 'someValue';
        $this->command->config($fakeConfig);
    }

    /*
     *  Depth Property
     */

    /**
     * Test Depth
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testDepth()
    {
        $expected = 5;

        $this->command->depth($expected);
        $this->assertEquals(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'depth')
        );
    }

    /**
     * Test Depth Empty
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testDepthEmpty()
    {
        $this->command->depth('');
        $this->assertNull(\PHPUnit_Framework_Assert::readAttribute($this->command, 'depth'));
    }

    /**
     * Test Depth Invalid
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testDepthInvalid()
    {
        $this->command->depth('invalid');
    }

    /*
     *  SingleBranch Property
     */

    /**
     * Test SingleBranch
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testSingleBranch()
    {
        $this->command->singleBranch();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'singleBranch'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noSingleBranch'));
    }

    /**
     * Test SingleBranch False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testSingleBranchFalse()
    {
        $this->command->singleBranch()->singleBranch();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'singleBranch'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noSingleBranch'));
    }

    /*
     *  NoSingleBranch Property
     */

    /**
     * Test NoSingleBranch
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testNoSingleBranch()
    {
        $this->command->noSingleBranch();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'singleBranch'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noSingleBranch'));
    }

    /**
     * Test NoSingleBranch False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testNoSingleBranchFalse()
    {
        $this->command->noSingleBranch()->noSingleBranch();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'singleBranch'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noSingleBranch'));
    }

    /*
     *  Recursive Property
     */

    /**
     * Test NoSingleBranch
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testRecursive()
    {
        $this->command->recursive();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'recursive'));
    }

    /**
     * Test NoSingleBranch False
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testRecursiveFalse()
    {
        $this->command->recursive()->recursive();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'recursive'));
    }

    /*
     *  GitDir Property
     */

    /**
     * Test SeparateGitDir
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testSeparateGitDir()
    {
        $config = $this->getConfig();

        $this->command->separateGitDir($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'separateGitDir')
        );
    }

    /**
     * Test SeparateGitDir Empty
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testSeparateGitDirEmptyString()
    {
        $config = $this->getConfig();

        $this->command->separateGitDir($config['tempFolder'])->separateGitDir('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'separateGitDir'));
    }

    /**
     * Test SeparateGitDir Invalid Parameter
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     * @expectedException \Git\Exception\DirectoryNotFoundException
     */
    public function testSeparateGitDirInvalid()
    {
        $this->command->separateGitDir('/not-a-folder-for-git');
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testGetCommand()
    {
        $config = $this->getConfig();

        $expected = $this->config['gitPath']
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
     * @covers \Git\Command\GitClone
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

        $gitMock = $this->getMockBuilder('\Git\Command\Git')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new GitClone($gitMock, array($config['tempFolder'], '.'));

        $expected = $this->config['gitPath']
            .' clone'
            .' --local'
            .' --no-hardlinks'
            .' --shared'
            .' --reference '.escapeshellarg($someNameSetter)
            .' --quiet'
            .' --verbose'
            .' --progress'
            .' --no-checkout'
            .' --bare'
            .' --mirror'
            .' --origin '.escapeshellarg($someNameSetter.'1')
            .' --branch '.escapeshellarg($someNameSetter.'2')
            .' --upload-pack '.escapeshellarg($someNameSetter.'3')
            .' --template='.escapeshellarg($config['tempFolder'].'/1')
            .' --config \'pushUpdateRejected\'=\'false\''
            .' --config \'color.ui\'=\'always\''
            .' --depth \'5\''
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
     * @covers \Git\Command\GitClone
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
