<?php
/**
 * IgnoreSkipWorktreeBits Argument
 *
 * This file contains the IgnoreSkipWorktreeBits Argument for Commands
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
 * IgnoreSkipWorktreeBits Argument
 *
 * IgnoreSkipWorktreeBits Argument.
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
trait IgnoreSkipWorktreeBitsArgument
{
    protected $ignoreSkipWorktreeBits = false;

    /**
     * In sparse checkout mode, git checkout -- <paths> would update only
     * entries matched by <paths> and sparse patterns in
     * $GIT_DIR/info/sparse-checkout. This option ignores the sparse
     * patterns and adds back any files in <paths>.
     *
     * @return $this
     */
    public function ignoreSkipWorktreeBits()
    {
        $this->ignoreSkipWorktreeBits = !$this->ignoreSkipWorktreeBits;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getIgnoreSkipWorktreeBits()
    {
        $cmd = '';

        if ($this->ignoreSkipWorktreeBits) {
            $cmd .= ' --ignore-skip-worktree-bits';
        }

        return $cmd;
    }
}
