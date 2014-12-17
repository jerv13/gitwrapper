<?php
/**
 * IgnoreSubmodules Argument
 *
 * This file contains the IgnoreSubmodules Argument for Commands
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
 * IgnoreSubmodules Argument
 *
 * IgnoreSubmodules Argument.
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
trait IgnoreSubmodulesArgument
{
    protected $ignoreSubmodules = '';

    /**
     * Ignore changes to submodules when looking for changes. <when> can
     * be either "none", "untracked", "dirty" or "all", which is the
     * default. Using "none" will consider the submodule modified when it
     * either contains untracked or modified files or its HEAD differs
     * from the commit recorded in the superproject and can be used to
     * override any settings of the ignore option in git-config(1) or
     * gitmodules(5). When "untracked" is used submodules are not
     * considered dirty when they only contain untracked content (but they
     * are still scanned for modified content). Using "dirty" ignores all
     * changes to the work tree of submodules, only changes to the commits
     * stored in the superproject are shown (this was the behavior before
     * 1.7.0). Using "all" hides all changes to submodules (and suppresses
     * the output of submodule summaries when the config option
     * status.submodulesummary is set).
     *
     * @param string $when Possible Values: "none", "untracked", "dirty" or "all"
     *
     * @return $this
     */
    public function ignoreSubmodules($when = 'all')
    {
        $when = strtolower($when);

        $allowed = array(
            'none',
            'untracked',
            'dirty',
            'all'
        );

        if (!empty($when) && !in_array($when, $allowed)) {
            throw new InvalidArgumentException(
                'Invalid mode.  Allowed: no, normal or all'
            );
        } elseif (empty($when)) {
            $when = '';
        }

        $this->ignoreSubmodules = $when;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getIgnoreSubmodules()
    {
        $cmd = '';

        if ($this->ignoreSubmodules) {
            $cmd .= ' --ignore-submodules='.escapeshellarg($this->ignoreSubmodules);
        }

        return $cmd;
    }
}
