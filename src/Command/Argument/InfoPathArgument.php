<?php
/**
 * InfoPath Argument
 *
 * This file contains the InfoPath Argument for Commands
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
 * InfoPath Argument
 *
 * InfoPath Argument.
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
trait InfoPathArgument
{
    protected $infoPath = false;

    /**
     * Print the path where the Info files documenting this version of Git
     * are installed and exit.
     *
     * @return $this
     */
    public function infoPath()
    {
        $this->infoPath = !$this->infoPath;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getInfoPath()
    {
        $cmd = '';

        if ($this->infoPath) {
            $cmd .= ' --info-path';
        }

        return $cmd;
    }
}
