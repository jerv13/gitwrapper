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

namespace Reliv\GitTest\Integration\Command;

use Reliv\Git\Command\AddCommand;
use Reliv\Git\Command\GitCommand;
use Reliv\Git\Command\CloneCommand;
use Reliv\GitTest\Integration\IntegrationBase;

require_once __DIR__ . '/../IntegrationBase.php';

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

class GitCommandTest extends IntegrationBase
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
        $this->command = new GitCommand($config['gitPath']);
    }

    /**
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testExecute()
    {
        $response = $this->command->version()->execute();
        $this->assertTrue($response->isSuccess());

        $message = $response->getMessage();
        $this->assertContains('git version', $message[0]);
    }
}
