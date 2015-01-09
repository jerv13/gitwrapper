<?php
/**
 * ExitCode Argument
 *
 * This file contains the ExitCode Argument for Commands
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
 * ExitCode Argument
 *
 * ExitCode Argument.
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
trait ExitCodeArgument
{
    protected $exitCode = false;

    /**
     * Exit with status "2" when no matching refs are found in the remote
     * repository. Usually the command exits with status "0" to indicate
     * it successfully talked with the remote repository, whether it found
     * any matching refs.
     *
     * @return $this
     */
    public function exitCode()
    {
        $this->exitCode = !$this->exitCode;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getExitCode()
    {
        $cmd = '';

        if ($this->exitCode) {
            $cmd .= ' --exit-code';
        }

        return $cmd;
    }
}
