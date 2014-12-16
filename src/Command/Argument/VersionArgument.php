<?php
/**
 * Version Argument
 *
 * This file contains the Version Argument for Commands
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
 * Version Argument
 *
 * Version Argument.
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
trait VersionArgument
{
    protected $version = false;

    /**
     * Prints the Git suite version that the git program came from.
     *
     * @return $this
     */
    public function version()
    {
        $this->version = !$this->version;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getVersion()
    {
        $cmd = '';

        if ($this->version) {
            $cmd .= ' --version';
        }

        return $cmd;
    }
}
