<?php
/**
 * Test for the Git Service Provider
 *
 * This file contains test for the Git Service Provider
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

namespace Reliv\GitTest\Service\Git;

use Reliv\Git\Command\GitCommand;
use Reliv\Git\Service\Git;
use Reliv\Git\Service\Repository;
use Reliv\GitTest\Integration\IntegrationBase;

require_once __DIR__ . '/../IntegrationBase.php';

/**
 * Test for the Git Service Provider
 *
 * Test for the Git Service Provider
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

class RepositoryTest extends IntegrationBase
{
    /** @var \Reliv\Git\Service\Repository */
    protected $repository;

    protected $tempFolder;

    protected $workingClone;

    /**
     * Setup Tests
     *
     * @return void
     */
    public function setup()
    {
        $config = $this->getConfig();
        $this->workingClone = $config['tempFolder'].$config['workingClone'];

        $this->initGitRepositories();

        $commandWrapper = new GitCommand($config['gitPath']);
        $this->repository = new Repository($this->workingClone, $commandWrapper);
    }

    /**
     * Test Is Remote
     *
     * @return void
     */
    public function testInitializeRepository()
    {
        $config = $this->getConfig();
        $commandWrapper = new GitCommand($config['gitPath']);
        $this->repository = new Repository('/www/gitTest', $commandWrapper);

    }
}
