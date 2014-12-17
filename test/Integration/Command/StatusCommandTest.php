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

namespace Reliv\GitTest\Integration\Command;

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

    protected $currentDir;

    public function setup()
    {
        parent::setup();

        $this->initTempDir();
        $this->initGitRepositories();

        $config = $this->getConfig();
        $workingClone   = $config['tempFolder'].$config['workingClone'];

        $this->currentDir = getcwd();
        chdir($workingClone);
        touch('myTestFile');
    }

    public function tearDown()
    {
        unlink('myTestFile');
        chdir($this->currentDir);
    }

    /**
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\StatusCommand
     */
    public function testExecute()
    {
        $response = $this->command->porcelain()->execute();

        $this->assertTrue($response->isSuccess());
        $this->assertEquals(
            '?? myTestFile',
            $response->getMessage()[0]
        );
    }
}
