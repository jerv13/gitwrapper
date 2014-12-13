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

namespace GitTest\Integration\Command;

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
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Git\Command\Git
     */
    public function testExecute()
    {
        $response = $this->command->version()->execute();
        $this->assertTrue($response->isSuccess());

        $message = $response->getMessage();
        $this->assertContains('git version', $message[0]);
    }
}
