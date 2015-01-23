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

namespace Reliv\GitTest\Unit\Service\Git;

use Reliv\Git\Service\Git;
use Reliv\GitTest\Unit\UnitBase;

require_once __DIR__ . '/../UnitBase.php';

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

class GitTest extends UnitBase
{
    /** @var \Reliv\Git\Service\Git */
    protected $gitService;

    protected $tempFolder;

    /**
     * Setup for tests
     *
     * @return void
     */
    public function setup()
    {
        $config = $this->getConfig();
        $this->initTempDir();
        $this->gitService = new Git($config['gitPath']);
        $this->tempFolder = $config['tempFolder'];
    }

    /**
     * Test the repositories are initialized
     *
     * @return void
     *
     * @covers Reliv\Git\Service\Git
     */
    public function testInitializeRepository()
    {
//        $testRepoDir = $this->tempFolder.'/integrationGitInitTest';
//
//        $this->delTree($testRepoDir);
//
//        $this->assertFalse(is_dir($testRepoDir));
//
//        $result = $this->gitService->initRepository($testRepoDir);
//
//        $this->assertTrue(is_dir($testRepoDir));
//
//        $this->assertInstanceOf('\Reliv\Git\Service\Repository', $result);
//
//        $this->delTree($testRepoDir);
    }
}
