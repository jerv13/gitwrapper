<?php
/**
 * SingleBranch Argument
 *
 * This file contains the SingleBranch Argument for Commands
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
 * SingleBranch Argument
 *
 * SingleBranch Argument.
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
trait SingleBranchArgument
{
    protected $singleBranch   = false;
    protected $noSingleBranch = false;

    /**
     * Clone only the history leading to the tip of a single branch,
     * either specified by the --branch option or the primary branch
     * remote's HEAD points at. When creating a shallow clone with the
     * --depth option, this is the default, unless --no-single-branch is
     * given to fetch the histories near the tips of all branches. Further
     * fetches into the resulting repository will only update the
     * remote-tracking branch for the branch this option was used for the
     * initial cloning. If the HEAD at the remote did not point at any
     * branch when --single-branch clone was made, no remote-tracking
     * branch is created.
     *
     * @return $this
     */
    public function singleBranch()
    {
        $this->singleBranch = !$this->singleBranch;
        $this->noSingleBranch = !$this->singleBranch;

        return $this;
    }

    /**
     * Clone only the history leading to the tip of a single branch,
     * either specified by the --branch option or the primary branch
     * remote's HEAD points at. When creating a shallow clone with the
     * --depth option, this is the default, unless --no-single-branch is
     * given to fetch the histories near the tips of all branches. Further
     * fetches into the resulting repository will only update the
     * remote-tracking branch for the branch this option was used for the
     * initial cloning. If the HEAD at the remote did not point at any
     * branch when --single-branch clone was made, no remote-tracking
     * branch is created.
     *
     * @return $this
     */
    public function noSingleBranch()
    {
        $this->noSingleBranch = !$this->noSingleBranch;
        $this->singleBranch = !$this->noSingleBranch;

        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getSingleBranch()
    {
        $cmd = '';

        if ($this->singleBranch) {
            $cmd .= ' --single-branch';
        }

        if ($this->noSingleBranch) {
            $cmd .= ' --no-single-branch';
        }

        return $cmd;
    }
}
