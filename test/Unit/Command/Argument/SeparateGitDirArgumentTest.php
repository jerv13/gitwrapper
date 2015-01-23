<?php
/**
 * Test for the SeparateGitDir argument
 *
 * This file contains test for the SeparateGitDir argument
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

use Reliv\GitTest\Unit\UnitBase;

require_once __DIR__ . '/../../UnitBase.php';


/**
 * Test for the SeparateGitDir argument
 *
 * Test for the SeparateGitDir argument
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

class SeparateGitDirArgumentTest extends UnitBase
{
    /** @var \Reliv\Git\Command\Argument\SeparateGitDirArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\SeparateGitDirArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\SeparateGitDirArgument', class_uses($this->argument)));
        $this->initTempDir();
    }

    /**
     * Test SeparateGitDir
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SeparateGitDirArgument
     */
    public function testSeparateGitDir()
    {
        $config = $this->getConfig();

        $this->argument->separateGitDir($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'separateGitDir')
        );
    }

    /**
     * Test SeparateGitDir Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SeparateGitDirArgument
     */
    public function testSeparateGitDirEmptyString()
    {
        $config = $this->getConfig();

        $this->argument->separateGitDir($config['tempFolder'])->separateGitDir('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'separateGitDir'));
    }

    /**
     * Test SeparateGitDir Invalid Parameter
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SeparateGitDirArgument
     * @expectedException \Reliv\Git\Exception\DirectoryNotFoundException
     */
    public function testSeparateGitDirInvalid()
    {
        $this->argument->separateGitDir('/not-a-folder-for-git');
    }
    
    /**
     * Test the getSeparateGitDir method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SeparateGitDirArgument
     */
    public function testGetSeparateGitDir()
    {
        $config = $this->getConfig();
        $tmpFolder = $config['tempFolder'];

        $expected = ' --separate-git-dir='.escapeshellarg($tmpFolder);
        $result = $this->argument->separateGitDir($tmpFolder)->getSeparateGitDir();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getSeparateGitDir method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SeparateGitDirArgument
     */
    public function testGetSeparateGitDirReturnsEmptyString()
    {
        $result = $this->argument->getSeparateGitDir();
        $this->assertEmpty($result);
    }
}
