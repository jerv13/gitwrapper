<?php
/**
 * Merge Argument
 *
 * This file contains the Merge Argument for Commands
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
 * Merge Argument
 *
 * Merge Argument.
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
trait MergeArgument
{
    protected $merge = false;

    /**
     * When switching branches, if you have local modifications to one or
     * more files that are different between the current branch and the
     * branch to which you are switching, the command refuses to switch
     * branches in order to preserve your modifications in context.
     * However, with this option, a three-way merge between the current
     * branch, your working tree contents, and the new branch is done, and
     * you will be on the new branch.
     *
     * When a merge conflict happens, the index entries for conflicting
     * paths are left unmerged, and you need to resolve the conflicts and
     * mark the resolved paths with git add (or git rm if the merge should
     * result in deletion of the path).
     *
     * When checking out paths from the index, this option lets you
     * recreate the conflicted merge in the specified paths.
     *
     * @return $this
     */
    public function merge()
    {
        $this->merge = !$this->merge;
        return $this;
    }

    /**
     * Alias of Merge
     *
     * @return $this
     */
    public function m()
    {
        return $this->merge();
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getMerge()
    {
        $cmd = '';

        if ($this->merge) {
            $cmd .= ' --merge';
        }

        return $cmd;
    }
}
