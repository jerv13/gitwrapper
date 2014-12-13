<?php

/**
 * Tag Command
 *
 * This file contains the Tag Command
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

use GitTest\Base as MainBase;
use Git\Command\Git;

require_once __DIR__ . '/../../Base.php';

/**
 * Tag Command
 *
 * Tag Command.  Create, list, delete or verify a tag object signed with GPG
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
class Base extends MainBase
{
    protected $command;

    protected $config;

    /** @var \Git\Command\Git */
    protected $gitCommandWrapper;

    public function setup()
    {
        parent::setup();

        $config = $this->getConfig();

        $this->gitCommandWrapper = new Git($config['gitPath']);

        $className = get_class($this);

        $className = str_replace('Test', '', $className);
        $className = str_replace('Integration\\', '', $className);

        $this->command = new $className($this->gitCommandWrapper);
    }

    public function getConfig()
    {
        if (empty($this->config)) {
            $this->config = include __DIR__ . '/../../../config.php';
        }

        return $this->config;
    }

    protected function delTree($dir) {
        if (!is_dir($dir)) {
            return true;
        }

        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }

        return rmdir($dir);
    }
}
