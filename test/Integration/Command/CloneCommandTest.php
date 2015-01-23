<?php
/**
 * Test for the GitClone command
 *
 * This file contains test for the GitClone command
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

use Reliv\Git\Command\GitCommand;
use Reliv\Git\Command\CloneCommand;
use Reliv\GitTest\Integration\Base;

require_once __DIR__ . '/../Base.php';

/**
 * Test for the GitClone command
 *
 * Test for the GitClone command
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

class GitCloneTest extends Base
{
    /** @var \Reliv\Git\Command\CloneCommand */
    protected $command;

    protected $repoToClone;
    protected $clonedRepoDir;

    /**
     * Setup for tests
     *
     * @return void
     */
    public function setup()
    {
        $config = $this->getConfig();
        $this->initGitRepositories();

        $this->repoToClone = $config['tempFolder'].$config['tempBareRepo'];
        $this->clonedRepoDir = $config['tempFolder'].'/cloneTest';

        $this->gitCommandWrapper = new GitCommand($config['gitPath']);

        $this->command = new CloneCommand(
            $this->gitCommandWrapper,
            $this->repoToClone,
            $this->clonedRepoDir
        );
    }

    /**
     * Tear down for tests
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        $this->delTree($this->clonedRepoDir);
    }

    /**
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\CloneCommand
     */
    public function testExecute()
    {
        $response = $this->command->execute();

        $this->assertTrue($response->isSuccess());
        $this->assertTrue(file_exists($this->clonedRepoDir.'/testFile'));

    }
}
