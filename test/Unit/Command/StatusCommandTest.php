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
     * Test the class default values
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testDefaults()
    {
        $defaults = array(
            'short'            => false,
            'branch'           => false,
            'porcelain'        => false,
            'long'             => false,
            'untrackedFiles'   => '',
            'ignoreSubmodules' => '',
            'ignored'          => false,
            'z'                => false,
            'column'           => '',
            'noColumn'         => '',
            'pathspec'         => false,
        );

        $this->defaultTester($this->command, $defaults);
    }

    /*
     *  Short Property
     */

    /**
     * Test Short
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testShort()
    {
        $this->command->short();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'short'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'porcelain'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'long'));
    }

    /**
     * Test Short False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testShortFalse()
    {
        $this->command->short()->short();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'short'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'porcelain'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'long'));
    }

    /*
     *  S Alias
     */

    /**
     * Test S
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testS()
    {
        $this->command->s();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'short'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'short'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'porcelain'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'long'));
    }

    /**
     * Test S False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testSFalse()
    {
        $this->command->s()->s();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'short'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'short'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'porcelain'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'long'));
    }

    /*
     *  Branch Property
     */

    /**
     * Test Branch
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testBranch()
    {
        $this->command->branch();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'branch'));
    }

    /**
     * Test Branch False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testBranchFalse()
    {
        $this->command->branch()->branch();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'branch'));
    }

    /*
     *  B Alias
     */

    /**
     * Test B
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testB()
    {
        $this->command->b();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'branch'));
    }

    /**
     * Test B False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testBFalse()
    {
        $this->command->b()->b();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'branch'));
    }

    /*
     *  Porcelain Property
     */

    /**
     * Test Porcelain
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testPorcelain()
    {
        $this->command->porcelain();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'porcelain'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'short'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'long'));
    }

    /**
     * Test Porcelain False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testPorcelainFalse()
    {
        $this->command->porcelain()->porcelain();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'porcelain'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'short'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'long'));
    }

    /*
     *  Long Property
     */

    /**
     * Test Long
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testLong()
    {
        $this->command->long();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'long'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'short'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'porcelain'));
    }

    /**
     * Test Long False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testLongFalse()
    {
        $this->command->long()->long();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'long'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'short'));
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'porcelain'));
    }

    /*
     *  Untracked Files Property
     */

    /**
     * Test UntrackedFiles
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testUntrackedFiles()
    {
        $this->command->untrackedFiles('NoRmAl');
        $this->assertEquals(
            'normal',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'untrackedFiles')
        );
    }

    /**
     * Test UntrackedFiles Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testUntrackedFilesEmpty()
    {
        $this->command->untrackedFiles('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'untrackedFiles'));
    }

    /**
     * Test UntrackedFiles Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testUntrackedFilesInvalid()
    {
        $this->command->untrackedFiles('invalid');
    }

    /*
     *  U Alias
     */

    /**
     * Test U
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testUFiles()
    {
        $this->command->u('NoRmAl');
        $this->assertEquals(
            'normal',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'untrackedFiles')
        );
    }

    /**
     * Test U Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testUFilesEmpty()
    {
        $this->command->u('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'untrackedFiles'));
    }

    /**
     * Test U Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testUFilesInvalid()
    {
        $this->command->untrackedFiles('invalid');
    }

    /*
     *  IgnoreSubmodules Files Property
     */

    /**
     * Test IgnoreSubmodules
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testIgnoreSubmodules()
    {
        $this->command->ignoreSubmodules('NonE');
        $this->assertEquals(
            'none',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'ignoreSubmodules')
        );
    }

    /**
     * Test IgnoreSubmodules Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testIgnoreSubmodulesEmpty()
    {
        $this->command->ignoreSubmodules('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'ignoreSubmodules'));
    }

    /**
     * Test IgnoreSubmodules Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testIgnoreSubmodulesInvalid()
    {
        $this->command->ignoreSubmodules('invalid');
    }

    /*
     *  Ignored Property
     */

    /**
     * Test Ignored
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testIgnored()
    {
        $this->command->ignored();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'ignored'));
    }

    /**
     * Test Ignored False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testIgnoredFalse()
    {
        $this->command->ignored()->ignored();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'ignored'));
    }

    /*
     *  Z Property
     */

    /**
     * Test Z
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testZ()
    {
        $this->command->z();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'z'));
    }

    /**
     * Test Z False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testZFalse()
    {
        $this->command->z()->z();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'z'));
    }

    /*
     *  Column Files Property
     */

    /**
     * Test Column
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testColumn()
    {
        $options = array(
            'AlWays',
            'Column',
            'Dense'
        );

        $this->command->column($options);
        $this->assertEquals(
            'always,column,dense',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'column')
        );
    }

    /**
     * Test Column Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testColumnEmpty()
    {
        $this->command->column(array());
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'column'));
    }

    /**
     * Test Column Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testColumnInvalid()
    {
        $this->command->column(array('invalid'));
    }

    /**
     * Test Column Only Accepts Array
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testColumnOnlyAcceptsArray()
    {
        $this->command->column('invalid');
    }

    /*
     *  NoColumn Property
     */

    /**
     * Test NoColumn
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testNoColumn()
    {
        $this->command->noColumn();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noColumn'));
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->command, 'column'));
    }

    /**
     * Test NoColumn False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testNoColumnFalse()
    {
        $this->command->noColumn()->noColumn();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'noColumn'));
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
