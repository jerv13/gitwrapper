<?php
/**
 * ManPath Argument
 *
 * This file contains the ManPath Argument for Commands
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
 * ManPath Argument
 *
 * ManPath Argument.
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
trait ManPathArgument
{
    protected $manPath = false;

    /**
     * Print the manPath (see man(1)) for the man pages for this version
     * of Git and exit.
     *
     * @return $this
     */
    public function manPath()
    {
        $this->manPath = !$this->manPath;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getManPath()
    {
        $cmd = '';

        if ($this->manPath) {
            $cmd .= ' --man-path';
        }

        return $cmd;
    }
}
