<?php
/**
 * Force Argument
 *
 * This file contains the Force Argument for Commands
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
 * Force Argument
 *
 * Force Argument.
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
trait ForceArgument
{
    protected $force = false;

    /**
     * When the repository to clone from is on a local machine, this flag
     * bypasses the normal "Git aware" transport mechanism and clones the
     * repository by making a copy of HEAD and everything under objects
     * and refs directories. The files under .git/objects/ directory are
     * hard linked to save space when possible.
     *
     * If the repository is specified as a local path
     * (e.g.,/path/to/repo), this is the default, and --local is essentially a
     * no-op. If the repository is specified as a URL, then this flag is
     * ignored (and we never use the local optimizations). Specifying
     * --no-local will override the default when /path/to/repo is given,
     * using the regular Git transport instead.
     *
     * @return $this
     */
    public function force()
    {
        $this->force = !$this->force;
        return $this;
    }

    /**
     * Alias of Force
     *
     * @return $this
     */
    public function f()
    {
        return $this->force();
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getForce()
    {
        $cmd = '';

        if ($this->force) {
            $cmd .= ' --force';
        }

        return $cmd;
    }
}
