<?php
/**
 * Test for the RunInPath argument
 *
 * This file contains test for the RunInPath argument
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

require_once __DIR__ . '/../../Base.php';


/**
 * Test for the RunInPath argument
 *
 * Test for the RunInPath argument
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

class RunInPathArgumentTest extends Base
{
    /** @var \Reliv\Git\Command\Argument\RunInPathArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\RunInPathArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\RunInPathArgument', class_uses($this->argument)));
        $this->initTempDir();
    }

    /**
     * Test RunInPath
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RunInPathArgument
     */
    public function testRunInPath()
    {
        $config = $this->getConfig();

        $this->argument->runInPath($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'runInPath')
        );
    }

    /**
     * Test RunInPath Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RunInPathArgument
     */
    public function testRunInPathEmptyString()
    {
        $config = $this->getConfig();

        $this->argument->runInPath($config['tempFolder'])->runInPath('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'runInPath'));
    }

    /**
     * Test RunInPath Invalid Parameter
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RunInPathArgument
     * @expectedException \Reliv\Git\Exception\DirectoryNotFoundException
     */
    public function testRunInPathInvalid()
    {
        $this->argument->runInPath('/not-a-folder-for-git');
    }


    /**
     * Test the getRunInPath method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RunInPathArgument
     */
    public function testGetRunInPath()
    {
        $config = $this->getConfig();
        $tmpFolder = $config['tempFolder'];

        $expected = ' -C '.escapeshellarg($tmpFolder);
        $result = $this->argument->runInPath($tmpFolder)->getRunInPath();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getRunInPath method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RunInPathArgument
     */
    public function testGetRunInPathReturnsEmptyString()
    {
        $result = $this->argument->getRunInPath();
        $this->assertEmpty($result);
    }
}
