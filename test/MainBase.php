<?php

/**
 * Base Test Class
 *
 * This file contains Base Test Case used by all test suites
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

namespace Reliv\GitTest;

require_once __DIR__ . '/autoload.php';

/**
 * Base Test Class
 *
 * Base Test Class
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
class MainBase extends \PHPUnit_Framework_TestCase
{
    protected $command;

    protected $config;

    public function setup()
    {
        $this->initTempDir();
    }

    public function tearDown()
    {
        $config = $this->getConfig();
        $tempDir = $config['tempFolder'];
        $this->delTree($tempDir);
    }

    public function getConfig()
    {
        if (empty($this->config)) {
            $this->config = include __DIR__ . '/config.php';
        }

        return $this->config;
    }

    public function initTempDir()
    {
        $config = $this->getConfig();
        $tempDir = $config['tempFolder'];
        $this->delTree($tempDir);
        mkdir($tempDir, 0777, true);
    }

    public function initGitRepositories()
    {
        $config = $this->getConfig();
        $tempBareRepoDir = $config['tempFolder'].$config['tempBareRepo'];
        $tempWorkingRepo = $config['tempFolder'].$config['workingClone'];

        $this->delTree($tempBareRepoDir);
        @mkdir($tempBareRepoDir, 0777, true);

        $this->delTree($tempWorkingRepo);
        @mkdir($tempWorkingRepo, 0777, true);


        shell_exec(escapeshellcmd($config['gitPath']).' -C '.escapeshellarg($tempBareRepoDir).' init --bare');
        shell_exec(escapeshellcmd($config['gitPath']).' -C '.escapeshellarg($tempWorkingRepo).' clone -q '.escapeshellarg($tempBareRepoDir).' . 2>&1');

        touch($tempWorkingRepo.'/testFile');
        shell_exec(escapeshellcmd($config['gitPath']).' -C '.escapeshellarg($tempWorkingRepo).' add testFile');
        shell_exec(escapeshellcmd($config['gitPath']).' -C '.escapeshellarg($tempWorkingRepo).' commit -m "First Commit"');
        shell_exec(escapeshellcmd($config['gitPath']).' -C '.escapeshellarg($tempWorkingRepo).' push origin master 2>&1');

        $this->assertTrue(is_file($tempBareRepoDir.'/HEAD'));
    }

    protected function delTree($dir) {
        if (!is_dir($dir) && !is_file($dir)) {
            return true;
        }

        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }

        return rmdir($dir);
    }
}
