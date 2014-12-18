<?php
/**
 * B Argument
 *
 * This file contains the B Argument for Commands
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

use Reliv\Git\Exception\InvalidArgumentException;

/**
 * B Argument
 *
 * B Argument.
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
trait BArgument
{
    protected $b           = '';
    protected $resetBranch = false;

    /**
     * Create a new branch named <new_branch> and start it at
     * <start_point>; see git-branch(1) for details.
     *
     * If reset is set to true: then if
     * the branch already exists, reset it to <start_point>. This is
     * equivalent to running "git branch" with "-f"; see git-branch(1) for
     * details.
     *
     * @param string  $newBranchName Name to use for new branch
     * @param boolean $resetBranch   Checkout and reset branch if it already exists (-B)
     *
     * @return $this
     */
    public function b($newBranchName, $resetBranch = false)
    {
        if (empty($newBranchName)) {
            $newBranchName = '';
        }

        $this->resetBranch = $resetBranch;
        $this->b = $newBranchName;

        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getB()
    {
        $cmd = '';

        if ($this->b && !$this->resetBranch) {
            $cmd .= ' -b';
        } elseif ($this->b && $this->resetBranch) {
            $cmd .= ' -B';
        }

        if ($this->b) {
            $cmd .= ' '.escapeshellarg($this->b);
        }

        return $cmd;
    }
}
