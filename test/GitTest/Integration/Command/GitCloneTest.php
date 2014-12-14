<?php
/**
 * Test for the GitClone command
 *
 * This file contains test for the GitClone command
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

use Git\Command\Git;
use Git\Command\GitClone;

require_once __DIR__ . '/Base.php';

/**
 * Test for the GitClone command
 *
 * Test for the GitClone command
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

class GitCloneTest extends Base
{
    /** @var \Git\Command\GitClone */
    protected $command;

    protected $repoToClone;
    protected $clonedRepoDir;

    public function setup()
    {
        $config = $this->getConfig();
        $this->initGitRepositories();

        $this->repoToClone = $config['tempFolder'].$config['tempBareRepo'];
        $this->clonedRepoDir = $config['tempFolder'].'/cloneTest';

        $this->gitCommandWrapper = new Git($config['gitPath']);

        $this->command = new GitClone(
            $this->gitCommandWrapper,
            $this->repoToClone,
            $this->clonedRepoDir
        );
    }

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
     * @covers \Git\Command\GitClone
     */
    public function testExecute()
    {
        $response = $this->command->execute();

        $this->assertTrue($response->isSuccess());
        $this->assertTrue(file_exists($this->clonedRepoDir.'/testFile'));

    }
}
