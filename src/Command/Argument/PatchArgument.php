<?php
/**
 * Patch Argument
 *
 * This file contains the Patch Argument for Commands
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
 * Patch Argument
 *
 * Patch Argument.
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
trait PatchArgument
{
    protected $patch = false;

    /**
     * When the repository to clone from is on a patch machine, this flag
     * bypasses the normal "Git aware" transport mechanism and clones the
     * repository by making a copy of HEAD and everything under objects
     * and refs directories. The files under .git/objects/ directory are
     * hard linked to save space when possible.
     *
     * If the repository is specified as a patch path
     * (e.g.,/path/to/repo), this is the default, and --patch is essentially a
     * no-op. If the repository is specified as a URL, then this flag is
     * ignored (and we never use the patch optimizations). Specifying
     * --no-patch will override the default when /path/to/repo is given,
     * using the regular Git transport instead.
     *
     * @return $this
     */
    public function patch()
    {
        $this->patch = !$this->patch;
        return $this;
    }

    /**
     * Alias of Patch
     *
     * @return $this
     */
    public function p()
    {
        return $this->patch();
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getPatch()
    {
        $cmd = '';

        if ($this->patch) {
            $cmd .= ' --patch';
        }

        return $cmd;
    }
}
