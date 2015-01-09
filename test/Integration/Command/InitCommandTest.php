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

namespace Reliv\GitTest\Integration\Command;

use Reliv\Git\Command\InitCommand;
use Reliv\GitTest\Integration\Base;

require_once __DIR__ . '/../Base.php';

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
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testExecute()
    {
        $path = $this->config['tempFolder'].'/testInit';
        $this->delTree($path);
        mkdir($path);
        $this->gitCommandWrapper->runInPath($path);

        $this->assertFalse(is_dir($path.'/.git'));

        $this->command->execute();

        $this->assertTrue(is_dir($path.'/.git'));
    }

    /**
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testExecuteBareRepo()
    {
        $path = $this->config['tempFolder'].'/testInit';
        $this->delTree($path);
        mkdir($path);
        $this->gitCommandWrapper->runInPath($path);

        $this->assertFalse(is_dir($path.'/.git'));

        $this->command->bare()->execute();

        $this->assertTrue(file_exists($path.'/HEAD'));
        $this->delTree($path);
    }
}
