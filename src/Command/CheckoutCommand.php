<?php

/**
 * Checkout Command
 *
 * This file contains the Checkout Command
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

use Reliv\Git\Command\Argument\BArgument;
use Reliv\Git\Command\Argument\ConflictArgument;
use Reliv\Git\Command\Argument\DetachArgument;
use Reliv\Git\Command\Argument\ForceArgument;
use Reliv\Git\Command\Argument\IgnoreSkipWorktreeBitsArgument;
use Reliv\Git\Command\Argument\LArgument;
use Reliv\Git\Command\Argument\MergeArgument;
use Reliv\Git\Command\Argument\OrphanArgument;
use Reliv\Git\Command\Argument\OursTheirsArgument;
use Reliv\Git\Command\Argument\PatchArgument;
use Reliv\Git\Command\Argument\QuietArgument;
use Reliv\Git\Command\Argument\TrackArgument;

/**
 * Checkout Command
 *
 * Checkout Command.  Checkout a branch or paths to the working tree
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
class CheckoutCommand extends CommandAbstract
{
    use QuietArgument;
    use ForceArgument;
    use OursTheirsArgument;
    use BArgument;
    use TrackArgument;
    use LArgument;
    use DetachArgument;
    use OrphanArgument;
    use IgnoreSkipWorktreeBitsArgument;
    use MergeArgument;
    use ConflictArgument;
    use PatchArgument;

    protected $branchOrCommit;

    /**
     * Constructor
     *
     * Requires the Branch, or Commit to checkout.
     *
     * <branch>
     *     Branch to checkout; if it refers to a branch (i.e., a name that,
     *     when prepended with "refs/heads/", is a valid ref), then that
     *     branch is checked out. Otherwise, if it refers to a valid commit,
     *     your HEAD becomes "detached" and you are no longer on any branch
     *     (see below for details).
     *
     *     As a special case, the "@{-N}" syntax for the N-th last
     *     branch/commit checks out branches (instead of detaching). You may
     *     also specify - which is synonymous with "@{-1}".
     *
     *     As a further special case, you may use "A...B" as a shortcut for
     *     the merge base of A and B if there is exactly one merge base. You
     *     can leave out at most one of A and B, in which case it defaults to
     *     HEAD.
     *
     * <start_point>
     *     The name of a commit at which to start the new branch; see git-
     *     branch(1) for details. Defaults to HEAD.
     *
     * @param CommandInterface $parent         Command to wrap
     * @param string           $branchOrCommit Branch or Commit
     */
    public function __construct(CommandInterface $parent, $branchOrCommit)
    {
        parent::__construct($parent);

        $this->branchOrCommit = $branchOrCommit;
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' checkout';
        $cmd .= $this->getQuiet();
        $cmd .= $this->getForce();
        $cmd .= $this->getOursTheirs();
        $cmd .= $this->getB();
        $cmd .= $this->getTrack();
        $cmd .= $this->getL();
        $cmd .= $this->getDetach();
        $cmd .= $this->getOrphan();
        $cmd .= $this->getIgnoreSkipWorktreeBits();
        $cmd .= $this->getMerge();
        $cmd .= $this->getConflict();
        $cmd .= $this->getPatch();

        $cmd .= ' '.escapeshellarg($this->branchOrCommit);

        return $cmd;
    }
}
