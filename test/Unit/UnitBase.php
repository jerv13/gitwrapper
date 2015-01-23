<?php

/**
 * Tag Command
 *
 * This file contains the Tag Command
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

namespace Reliv\GitTest\Unit;

use Reliv\GitTest\MainBase;

require_once __DIR__ . '/../MainBase.php';

/**
 * Tag Command
 *
 * Tag Command.  Create, list, delete or verify a tag object signed with GPG
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
class UnitBase extends MainBase
{
    protected $command;

    protected $config;

    /**
     * Generic setup for tests
     *
     * @return void
     */
    public function setup()
    {
        parent::setup();

        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $className = get_class($this);

        $className = str_replace('Test', '', $className);
        $className = str_replace('Unit\\', '', $className);

        $this->command = new $className($gitMock);
    }

    /**
     * Generic TearDown for tests
     *
     * @return void
     */
    public function tearDown()
    {
        $config = $this->getConfig();
        $tempDir = $config['tempFolder'];
        $this->delTree($tempDir);
    }

    /**
     * Initialize the temp directory
     *
     * @return void
     */
    public function initTempDir()
    {
        $config = $this->getConfig();
        $tempDir = $config['tempFolder'];
        $this->delTree($tempDir);
        mkdir($tempDir, 0777, true);
    }


    /**
     * Get the unit test config file.
     *
     * @return array
     */
    public function getConfig()
    {
        if (empty($this->config)) {
            $this->config = include __DIR__ . '/config.php';
        }

        return $this->config;
    }
}
