<?php
/**
 * GitDir Argument
 *
 * This file contains the GitDir Argument for Commands
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

namespace Reliv\Git\Command\Argument;

use Reliv\Git\Exception\DirectoryNotFoundException;

/**
 * GitDir Argument
 *
 * GitDir Argument.
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
trait GitDirArgument
{
    protected $gitDir = '';

    /**
     * Set the path to the repository. This can also be controlled by
     * setting the GIT_DIR environment variable. It can be an absolute
     * path or relative path to current working directory.
     *
     * @param string $path Path to the git repository
     *
     * @return $this
     */
    public function gitDir($path)
    {
        if (!empty($path) && !is_dir($path)) {
            throw new DirectoryNotFoundException('No directory found at: '.$path);
        } elseif (empty($path)) {
            $path = '';
        }

        $this->gitDir = $path;

        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getGitDir()
    {
        $cmd = '';

        if (!empty($this->gitDir)) {
            $cmd .= ' --git-dir='.escapeshellarg($this->gitDir);
        }

        return $cmd;
    }
}
