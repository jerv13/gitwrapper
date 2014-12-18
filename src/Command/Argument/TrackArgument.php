<?php
/**
 * Track Argument
 *
 * This file contains the Track Argument for Commands
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
 * Track Argument
 *
 * Track Argument.
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
trait TrackArgument
{
    protected $track   = false;
    protected $noTrack = false;

    /**
     * When creating a new branch, set up "upstream" configuration. See
     * "--track" in git-branch(1) for details.
     *
     * If no -b option is given, the name of the new branch will be
     * derived from the remote-tracking branch, by looking at the local
     * part of the refspec configured for the corresponding remote, and
     * then stripping the initial part up to the "*". This would tell us
     * to use "hack" as the local branch when branching off of
     * "origin/hack" (or "remotes/origin/hack", or even
     * "refs/remotes/origin/hack"). If the given name has no slash, or the
     * above guessing results in an empty name, the guessing is aborted.
     * You can explicitly give a name with -b in such a case.
     *
     * @return $this
     */
    public function track()
    {
        $this->track   = !$this->track;
        $this->noTrack = false;
        return $this;
    }

    /**
     * Alias of Track
     *
     * @return $this
     */
    public function t()
    {
        return $this->track();
    }

    /**
     * Do not set up "upstream" configuration, even if the
     * branch.autosetupmerge configuration variable is true.
     *
     * @return $this
     */
    public function noTrack()
    {
        $this->noTrack   = !$this->noTrack;
        $this->track = false;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getTrack()
    {
        $cmd = '';

        if ($this->track) {
            $cmd .= ' --track';
        }

        if ($this->noTrack) {
            $cmd .= ' --no-track';
        }

        return $cmd;
    }
}
