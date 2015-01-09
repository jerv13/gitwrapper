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

namespace Reliv\GitTest\Integration;

use Reliv\GitTest\MainBase;
use Reliv\Git\Command\GitCommand;

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
class Base extends MainBase
{
    protected $command;

    protected $config;

    /** @var \Reliv\Git\Command\GitCommand */
    protected $gitCommandWrapper;

    public function setup()
    {
        parent::setup();

        $config = $this->getConfig();

        $this->gitCommandWrapper = new GitCommand($config['gitPath']);

        $className = get_class($this);

        $className = str_replace('Test', '', $className);
        $className = str_replace('Integration\\', '', $className);

        $this->command = new $className($this->gitCommandWrapper);
    }

    public function initGitRepositories()
    {
        $config = $this->getConfig();
        $tempBareRepoDir = $config['tempFolder'].$config['tempBareRepo'];
        $tempWorkingRepo = $config['tempFolder'].$config['workingClone'];
        $outOfDateRepo   = $config['tempFolder'].$config['outOfDateClone'];

        $this->delTree($tempBareRepoDir);
        @mkdir($tempBareRepoDir, 0777, true);

        $this->delTree($tempWorkingRepo);
        @mkdir($tempWorkingRepo, 0777, true);

        $this->delTree($outOfDateRepo);
        @mkdir($outOfDateRepo, 0777, true);


        /** Bare Repo */
        shell_exec(escapeshellcmd($config['gitPath']).' -C '.escapeshellarg($tempBareRepoDir).' init --bare');

        /** Working Repo */
        shell_exec(escapeshellcmd($config['gitPath']).' -C '.escapeshellarg($tempWorkingRepo).' clone -q '.escapeshellarg($tempBareRepoDir).' . 2>&1');

        /** Out of Date Repo */
        shell_exec(escapeshellcmd($config['gitPath']).' -C '.escapeshellarg($outOfDateRepo).' clone -q '.escapeshellarg($tempBareRepoDir).' . 2>&1');

        touch($tempWorkingRepo.'/testFile');
        shell_exec(escapeshellcmd($config['gitPath']).' -C '.escapeshellarg($tempWorkingRepo).' add testFile');
        shell_exec(escapeshellcmd($config['gitPath']).' -C '.escapeshellarg($tempWorkingRepo).' commit -m "First Commit"');
        shell_exec(escapeshellcmd($config['gitPath']).' -C '.escapeshellarg($tempWorkingRepo).' push origin master 2>&1');

        $this->assertTrue(is_file($tempBareRepoDir.'/HEAD'));
    }
}
