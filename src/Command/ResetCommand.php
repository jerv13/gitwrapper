<?php

/**
 * Reset Command
 *
 * This file contains the Reset Command
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

namespace Reliv\Git\Command;

use Reliv\Git\Command\Argument\PatchArgument;
use Reliv\Git\Command\Argument\QuietArgument;

/**
 * Reset Command
 *
 * Reset Command.  Reset current HEAD to the specified state
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
class ResetCommand extends CommandAbstract
{
    use QuietArgument;
    use PatchArgument;

    protected $mode = '';
    protected $treeishOrCommit;
    protected $paths;

    /**
     * Constructor.
     *
     * @param CommandInterface $parent          Command to wrap
     * @param string           $treeishOrCommit Tree-ish or Commit
     * @param string           $paths           Paths.  Only usefull when using
     *                                          tree-ish instead of commit
     */
    public function __construct(
        CommandInterface $parent,
        $treeishOrCommit = null,
        $paths = null
    ) {
        parent::__construct($parent);

        if (!empty($treeishOrCommit)) {
            $this->treeishOrCommit = $treeishOrCommit;
        }

        if (!empty($paths)) {
            $this->paths = $paths;
        }
    }


    /**
     * Does not touch the index file or the working tree at all (but
     * resets the head to <commit>, just like all modes do). This
     * leaves all your changed files "Changes to be committed", as git
     * status would put it.
     *
     * @return $this
     */
    public function soft()
    {
        $this->mode = 'soft';
        return $this;
    }

    /**
     * Resets the index but not the working tree (i.e., the changed
     * files are preserved but not marked for commit) and reports what
     * has not been updated. This is the default action.
     *
     * If -N is specified, removed paths are marked as intent-to-add
     * (see git-add(1)).
     *
     * @return $this
     */
    public function mixed()
    {
        $this->mode = 'mixed';
        return $this;
    }

    /**
     * Resets the index and working tree. Any changes to tracked files
     * in the working tree since <commit> are discarded.
     *
     * @return $this
     */
    public function hard()
    {
        $this->mode = 'hard';
        return $this;
    }

    /**
     * Resets the index and updates the files in the working tree that
     * are different between <commit> and HEAD, but keeps those which
     * are different between the index and working tree (i.e. which
     * have changes which have not been added). If a file that is
     * different between <commit> and the index has unstaged changes,
     * reset is aborted.
     *
     * In other words, --merge does something like a git read-tree -u
     * -m <commit>, but carries forward unmerged index entries.
     *
     * @return $this
     */
    public function merge()
    {
        $this->mode = 'merge';
        return $this;
    }

    /**
     * Resets index entries and updates files in the working tree that
     * are different between <commit> and HEAD. If a file that is
     * different between <commit> and HEAD has local changes, reset is
     * aborted.
     *
     * @return $this
     */
    public function keep()
    {
        $this->mode = 'keep';
        return $this;
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' reset';
        $cmd .= $this->getQuiet();
        $cmd .= $this->getPatch();

        if (!empty($this->mode)) {
            $cmd .= ' --'.$this->mode;
        }

        if (!empty($this->treeishOrCommit)) {
            $cmd .= ' '.escapeshellarg($this->treeishOrCommit);
        }

        if (!empty($this->paths)) {
            $cmd .= ' -- '.escapeshellarg($this->paths);
        }

        return $cmd;
    }
}
