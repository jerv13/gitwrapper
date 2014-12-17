<?php
/**
 * Shared Object Argument
 *
 * This file contains the Shared Object Argument for Commands
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
 * Shared Object Argument
 *
 * Shared Object Argument.
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
trait SharedObjectArgument
{
    protected $shared = false;

    /**
     * When the repository to clone is on the local machine, instead of
     * using hard links, automatically setup .git/objects/info/alternates
     * to share the objects with the source repository. The resulting
     * repository starts out without any object of its own.
     *
     * NOTE: this is a possibly dangerous operation; do not use it unless
     * you understand what it does. If you clone your repository using
     * this option and then delete branches (or use any other Git command
     * that makes any existing commit unreferenced) in the source
     * repository, some objects may become unreferenced (or dangling).
     * These objects may be removed by normal Git operations (such as git
     * commit) which automatically call git gc --auto. (See git-gc(1).) If
     * these objects are removed and were referenced by the cloned
     * repository, then the cloned repository will become corrupt.
     *
     * Note that running git repack without the -l option in a repository
     * cloned with -s will copy objects from the source repository into a
     * pack in the cloned repository, removing the disk space savings of
     * clone -s. It is safe, however, to run git gc, which uses the -l
     * option by default.
     *
     * If you want to break the dependency of a repository cloned with -s
     * on its source repository, you can simply run git repack -a to copy
     * all objects from the source repository into a pack in the cloned
     * repository.
     *
     * @return $this
     */
    public function shared()
    {
        $this->shared = !$this->shared;
        return $this;
    }

    /**
     * Alias of Shared
     *
     * @return $this
     */
    public function s()
    {
        return $this->shared();
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getShared()
    {
        $cmd = '';

        if ($this->shared) {
            $cmd .= ' --shared';
        }

        return $cmd;
    }
}
