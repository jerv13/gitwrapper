<?php
/**
 * Mirror Argument
 *
 * This file contains the Mirror Argument for Commands
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
 * Mirror Argument
 *
 * Mirror Argument.
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
trait MirrorArgument
{
    protected $mirror = false;

    /**
     * Set up a mirror of the source repository. This implies --bare.
     * Compared to --bare, --mirror not only maps local branches of the
     * source to local branches of the target, it maps all refs (including
     * remote-tracking branches, notes etc.) and sets up a refspec
     * configuration such that all these refs are overwritten by a git
     * remote update in the target repository.
     *
     * @return $this
     */
    public function mirror()
    {
        $this->mirror = !$this->mirror;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getMirror()
    {
        $cmd = '';

        if ($this->mirror) {
            $cmd .= ' --mirror';
        }

        return $cmd;
    }
}
