<?php
/**
 * Test for the Init command
 *
 * This file contains test for the Init command
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

use Reliv\Git\Command\InitCommand;

require_once __DIR__ . '/Base.php';

/**
 * Test for the Init command
 *
 * Test for the Init command
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

class InitCommandTest extends Base
{
    /** @var \Reliv\Git\Command\InitCommand */
    protected $command;

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof InitCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );
    }

    /**
     * Test the class default values
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testDefaults()
    {
        $defaults = array(
            'quiet'          => false,
            'bare'           => false,
            'template'       => '',
            'separateGitDir' => '',
            'shared'         => 'umask',
        );

        $this->defaultTester($this->command, $defaults);
    }

    /*
     *  quiet Property
     */

    /**
     * Test quiet
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
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
     * @covers \Reliv\Git\Command\InitCommand
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
     * @covers \Reliv\Git\Command\InitCommand
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
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testQFalse()
    {
        $this->command->q()->q();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'quiet'));
    }

    /*
     *  Bare Property
     */

    /**
     * Test Bare
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
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
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testBareFalse()
    {
        $this->command->bare()->bare();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->command, 'bare'));
    }

    /*
     *  GitDir Property
     */

    /**
     * Test SeparateGitDir
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
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
     * @covers \Reliv\Git\Command\InitCommand
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
     * @covers \Reliv\Git\Command\InitCommand
     * @expectedException \Reliv\Git\Exception\DirectoryNotFoundException
     */
    public function testSeparateGitDirInvalid()
    {
        $this->command->separateGitDir('/not-a-folder-for-git');
    }

    /*
     *  Template Property
     */

    /**
     * Test Template
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
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
     * @covers \Reliv\Git\Command\InitCommand
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
     * @covers \Reliv\Git\Command\InitCommand
     * @expectedException \Reliv\Git\Exception\DirectoryNotFoundException
     */
    public function testTemplateInvalid()
    {
        $this->command->template('/not-a-folder-for-git');
    }

    /*
     *  Shared Property
     */

    /**
     * Test Shared Parameter with value
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testShared()
    {
        $this->command->shared();
        $this->assertEquals(
            'group',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'shared')
        );
    }

    /**
     * Test Shared Parameter with value
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testSharedWithValue()
    {
        $this->command->shared('all');
        $this->assertEquals(
            'all',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'shared')
        );
    }

    /**
     * Test Shared Parameter with 'all' aliases
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testSharedWithAliasForAll()
    {
        $this->command->shared('world');
        $this->assertEquals(
            'all',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'shared')
        );

        $this->command->shared('everybody');
        $this->assertEquals(
            'all',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'shared')
        );
    }

    /**
     * Test Shared Parameter False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testSharedFalse()
    {
        $this->command->shared(false);
        $this->assertEquals(
            'umask',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'shared')
        );
    }

    /**
     * Test Shared Parameter Null
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testSharedNull()
    {
        $this->command->shared(null);
        $this->assertEquals(
            'group',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'shared')
        );
    }

    /**
     * Test Shared Parameter True Boolean
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testSharedTrue()
    {
        $this->command->shared(true);
        $this->assertEquals(
            'group',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'shared')
        );

        $this->command->shared('true');
        $this->assertEquals(
            'group',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'shared')
        );
    }

    /**
     * Test Shared Parameter Octal
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testSharedOctal()
    {
        $this->command->shared('664');
        $this->assertEquals(
            '664',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'shared')
        );
    }

    /**
     * Test Shared Parameter Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testSharedInvalid()
    {
        $this->command->shared('Invalid');
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testGetCommand()
    {
        $expected = $this->config['gitPath'].' init';
        $result = $this->command->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with all options turned on
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testGetCommandAllOptions()
    {
        $path = $this->config['tempFolder'];

        $expected = $this->config['gitPath']
            .' init'
            .' --quiet'
            .' --bare'
            .' --template='.escapeshellarg($path)
            .' --separate-git-dir='.escapeshellarg($path)
            .' --shared='.escapeshellarg('group');

        $result = $this->command
            ->quiet()
            ->bare()
            ->template($path)
            ->separateGitDir($path)
            ->shared()
            ->getCommand();

        $this->assertEquals($expected, $result);
    }
}
