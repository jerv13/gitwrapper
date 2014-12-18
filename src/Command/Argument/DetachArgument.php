<?php
/**
 * Detach Argument
 *
 * This file contains the Detach Argument for Commands
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
 * Detach Argument
 *
 * Detach Argument.
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
trait DetachArgument
{
    protected $detach = false;

    /**
     * Rather than checking out a branch to work on it, check out a commit for
     * inspection and discardable experiments. This is the default behavior of
     * "git checkout <commit>" when <commit> is not a branch name. See the
     * "DETACHED HEAD" section below for details.
     *
     * @return $this
     */
    public function detach()
    {
        $this->detach = !$this->detach;
        return $this;
    }


    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getDetach()
    {
        $cmd = '';

        if ($this->detach) {
            $cmd .= ' --detach';
        }

        return $cmd;
    }
}
