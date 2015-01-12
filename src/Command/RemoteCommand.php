<?php

/**
 * Remote Command
 *
 * This file contains the Remote Command
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

namespace Reliv\Git\Command;

use Reliv\Git\Command\Argument\VerboseArgument;

/**
 * Remote Command
 *
 * Remote Command.  Manage set of tracked repositories
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
class RemoteCommand extends CommandAbstract
{

    use VerboseArgument;

    /**
     * Remote Add Command
     *
     * @param string $name Name of remote
     * @param string $url  Url to remote
     *
     * @return RemoteAddCommand
     */
    public function add($name, $url)
    {
        return new RemoteAddCommand($this, $name, $url);
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' remote';
        $cmd .= $this->getVerbose();
        return $cmd;
    }
}
