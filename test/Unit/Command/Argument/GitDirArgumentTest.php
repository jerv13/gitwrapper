<?php
/**
 * Test for the GitDir argument
 *
 * This file contains test for the GitDir argument
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

namespace Reliv\GitTest\Unit\Command\Argument;

use Reliv\GitTest\Unit\Command\Base;

require_once __DIR__ . '/../Base.php';


/**
 * Test for the GitDir argument
 *
 * Test for the GitDir argument
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

class GitDirArgumentTest extends Base
{
    /** @var \Reliv\Git\Command\Argument\GitDirArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\GitDirArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\GitDirArgument', class_uses($this->argument)));
        $this->initTempDir();
    }

    /**
     * Test GitDir
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GitDirArgument
     */
    public function testGitDir()
    {
        $config = $this->getConfig();

        $this->argument->gitDir($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'gitDir')
        );
    }

    /**
     * Test GitDir Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GitDirArgument
     */
    public function testGitDirEmptyString()
    {
        $config = $this->getConfig();

        $this->argument->gitDir($config['tempFolder'])->gitDir('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'gitDir'));
    }

    /**
     * Test GitDir Invalid Parameter
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GitDirArgument
     * @expectedException \Reliv\Git\Exception\DirectoryNotFoundException
     */
    public function testGitDirInvalid()
    {
        $this->argument->gitDir('/not-a-folder-for-git');
    }


    /**
     * Test the getGitDir method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GitDirArgument
     */
    public function testGetGitDir()
    {
        $config = $this->getConfig();
        $tmpFolder = $config['tempFolder'];
        $expected = ' --git-dir='.escapeshellarg($tmpFolder);
        $result = $this->argument->gitDir($tmpFolder)->getGitDir();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getGitDir method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\GitDirArgument
     */
    public function testGetGitDirReturnsEmptyString()
    {
        $result = $this->argument->getGitDir();
        $this->assertEmpty($result);
    }

}
