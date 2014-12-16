<?php
/**
 * Executable Argument
 *
 * This file contains the Executable Argument for Commands
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

use Reliv\Git\Exception\DirectoryNotFoundException;

/**
 * Executable Argument
 *
 * Executable Argument.
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
trait ExecPathArgument
{
    protected $execPath = false;

    /**
     * Path to wherever your core Git programs are installed. This can
     * also be controlled by setting the GIT_EXEC_PATH environment
     * variable. If no path is given, git will print the current setting
     * and then exit.
     *
     * @param string|boolean $path Path to git executable files.  If empty string is given
     *                             then git will print the current setting and then exit upon
     *                             execution.
     *
     * @return $this
     */
    public function execPath($path = null)
    {
        if (!empty($path) && !is_dir($path)) {
            throw new DirectoryNotFoundException('No directory found at: '.$path);
        } elseif ($path === false) {
            $path = false;
        } elseif (empty($path)) {
            $path = '';
        }

        $this->execPath = $path;

        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getExecPath()
    {
        $cmd = '';

        if (!empty($this->execPath)) {
            $cmd .= ' --exec-path='.escapeshellarg($this->execPath);
        } elseif ($this->execPath !== false) {
            $cmd .= ' --exec-path';
        }

        return $cmd;
    }
}
