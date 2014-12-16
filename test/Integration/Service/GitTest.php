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

use Reliv\Git\Service\Git;
use Reliv\GitTest\Base;
use Reliv\GitTest\MainBase;

require_once __DIR__ . '/../../MainBase.php';

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

class GitTest extends MainBase
{
    /** @var \Reliv\Git\Service\Git */
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

        $this->assertInstanceOf('\Reliv\Git\Service\Repository', $result);

        $this->delTree($testRepoDir);
    }

}
