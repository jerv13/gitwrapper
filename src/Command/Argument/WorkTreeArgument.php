<?php
/**
 * WorkTree Argument
 *
 * This file contains the WorkTree Argument for Commands
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
 * WorkTree Argument
 *
 * WorkTree Argument.
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
trait WorkTreeArgument
{
    protected $workTree = '';

    /**
     * Set the path to the working tree. It can be an absolute path or a
     * path relative to the current working directory. This can also be
     * controlled by setting the GIT_WORK_TREE environment variable and
     * the core.worktree configuration variable (see core.worktree in git-
     * config(1) for a more detailed discussion).
     *
     * @param string $path Path the git work tree
     *
     * @return $this
     */
    public function workTree($path)
    {
        if (!empty($path) && !is_dir($path)) {
            throw new DirectoryNotFoundException('No directory found at: '.$path);
        } elseif (empty($path)) {
            $path = '';
        }

        $this->workTree = $path;

        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getWorkTree()
    {
        $cmd = '';

        if (!empty($this->workTree)) {
            $cmd .= ' --work-tree='.escapeshellarg($this->workTree);
        }

        return $cmd;
    }
}
