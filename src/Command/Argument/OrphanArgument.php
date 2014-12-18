<?php
/**
 * Orphan Argument
 *
 * This file contains the Orphan Argument for Commands
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
 * Orphan Argument
 *
 * Orphan Argument.
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
trait OrphanArgument
{
    protected $orphan = '';

    /**
     * Create a new orphan branch, named <new_branch>, started from
     * <start_point> and switch to it. The first commit made on this new
     * branch will have no parents and it will be the root of a new
     * history totally disconnected from all the other branches and
     * commits.
     *
     * The index and the working tree are adjusted as if you had
     * previously run "git checkout <start_point>". This allows you to
     * start a new history that records a set of paths similar to
     * <start_point> by easily running "git commit -a" to make the root
     * commit.
     *
     * This can be useful when you want to publish the tree from a commit
     * without exposing its full history. You might want to do this to
     * publish an open source branch of a project whose current tree is
     * "clean", but whose full history contains proprietary or otherwise
     * encumbered bits of code.
     *
     * If you want to start a disconnected history that records a set of
     * paths that is totally different from the one of <start_point>, then
     * you should clear the index and the working tree right after
     * creating the orphan branch by running "git rm -rf ." from the top
     * level of the working tree. Afterwards you will be ready to prepare
     * your new files, repopulating the working tree, by copying them from
     * elsewhere, extracting a tarball, etc.
     *
     * @param string $newBranch Name to use for the new Orphan Branch
     *
     * @return $this
     */
    public function orphan($newBranch)
    {
        if (empty($newBranch)) {
            $newBranch = '';
        }

        $this->orphan = $newBranch;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getOrphan()
    {
        $cmd = '';

        if ($this->orphan) {
            $cmd .= ' --orphan='.escapeshellarg($this->orphan);
        }

        return $cmd;
    }
}
