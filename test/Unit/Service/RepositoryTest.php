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
use Reliv\Git\Service\Repository;
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

class RepositoryTest extends MainBase
{
    /** @var \Reliv\Git\Service\Repository */
    protected $repository;

    protected $tempFolder;

    /**
     * Setup Tests
     *
     * @return void
     */
    public function setup()
    {
        $config = $this->getConfig();
        $this->tempFolder = $config['tempFolder'];
        $mockGitWrapper = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $this->repository = new Repository($this->tempFolder, $mockGitWrapper);
    }

    /**
     * Test isRemote with HTTPS
     *
     * @return void
     */
    public function testRepositoryIsRemoteWithHTTPS()
    {
        $mockGitWrapper = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $repository = new Repository('https://reliv.com/someRepo', $mockGitWrapper);

        $this->assertTrue($repository->isRemote());
    }

    /**
     * Test isRemote with HTTP
     *
     * @return void
     */
    public function testRepositoryIsRemoteWithHTTP()
    {
        $mockGitWrapper = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $repository = new Repository('http://reliv.com/someRepo', $mockGitWrapper);

        $this->assertTrue($repository->isRemote());
    }

    /**
     * Test isRemote with Git Protocol
     *
     * @return void
     */
    public function testRepositoryIsRemoteWithOldGitProtocol()
    {
        $mockGitWrapper = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $repository = new Repository('git://reliv.com/someRepo', $mockGitWrapper);

        $this->assertTrue($repository->isRemote());
    }

    /**
     * Test isRemote with SSH
     *
     * @return void
     */
    public function testRepositoryIsRemoteWithSsh()
    {
        $mockGitWrapper = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $repository = new Repository('git@reliv.com:someRepo/somerepo.git', $mockGitWrapper);

        $this->assertTrue($repository->isRemote());
    }

    /**
     * Test isRemote with File Path
     *
     * @return void
     */
    public function testRepositoryIsRemoteWithFilePath()
    {
        $this->assertFalse($this->repository->isRemote());
    }

    /**
     * test isRemote with invalid file path
     *
     * @return void
     */
    public function testRepositoryIsRemoteWithInvalidFilePath()
    {
        $mockGitWrapper = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $repository = new Repository('/notHere/I/m/pretty/sure', $mockGitWrapper);

        $this->assertFalse($repository->isRemote());
    }
}
