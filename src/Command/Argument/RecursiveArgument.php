<?php
/**
 * Recursive Argument
 *
 * This file contains the Recursive Argument for Commands
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

/**
 * Recursive Argument
 *
 * Recursive Argument.
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
trait RecursiveArgument
{
    protected $recursive = false;

    /**
     * After the clone is created, initialize all submodules within, using
     * their default settings. This is equivalent to running git submodule
     * update --init --recursive immediately after the clone is finished.
     *
     * This option is ignored if the cloned repository does not have a
     * worktree/checkout (i.e. if any of --no-checkout/-n, --bare, or
     * --mirror is given)
     *
     * @return $this
     */
    public function recursive()
    {
        $this->recursive = !$this->recursive;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getRecursive()
    {
        $cmd = '';

        if ($this->recursive) {
            $cmd .= ' --recursive';
        }

        return $cmd;
    }
}
