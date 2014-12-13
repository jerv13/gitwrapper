<?php
/**
 * Test for the Git Service Provider
 *
 * This file contains test for the Git Service Provider
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

namespace GitTest\Service\Git;

use Git\Service\Git;
use GitTest\Base;

require_once __DIR__ . '/../../Base.php';

/**
 * Test for the Git Service Provider
 *
 * Test for the Git Service Provider
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
    /** @var \Git\Service\Git */
    protected $gitService;

    protected $tempFolder;

    public function setup()
    {
        $config = $this->getConfig();
        $this->gitService = new Git($config['gitPath']);
        $this->tempFolder = $config['tempFolder'];
    }

    public function testInitializeRepository()
    {
        $testRepoDir = $this->tempFolder.'/integrationGitInitTest';

        $this->delTree($testRepoDir);

        $this->assertFalse(is_dir($testRepoDir));

        $result = $this->gitService->initRepository($testRepoDir);

        $this->assertTrue(is_dir($testRepoDir));

        $this->assertInstanceOf('\Git\Service\Repository', $result);

        $this->delTree($testRepoDir);
    }

}
