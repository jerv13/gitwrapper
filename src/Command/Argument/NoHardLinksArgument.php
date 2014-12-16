<?php
/**
 * NoHardLinks Argument
 *
 * This file contains the NoHardLinks Argument for Commands
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
 * NoHardLinks Argument
 *
 * NoHardLinks Argument.
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
trait NoHardLinksArgument
{
    protected $noHardLinks    = false;

    /**
     * Force the cloning process from a repository on a local filesystem
     * to copy the files under the .git/objects directory instead of using
     * hardlinks. This may be desirable if you are trying to make a
     * back-up of your repository.
     *
     * @return $this
     */
    public function noHardLinks()
    {
        $this->noHardLinks = !$this->noHardLinks;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getNoHardLinks()
    {
        $cmd = '';

        if ($this->noHardLinks) {
            $cmd .= ' --no-hardlinks';
        }

        return $cmd;
    }
}
