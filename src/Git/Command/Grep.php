<?php

/**
 * Grep Command
 *
 * This file contains the Grep Command
 *
 * PHP version 5.3
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

namespace Git\Command;

/**
 * Grep Command
 *
 * Grep Command.  Print lines matching a pattern.
 *
 * PHP version 5.3
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
class Grep extends CommandAbstract
{
    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        throw new CommandNotImplementedException('This command has not been implemented yet.');
    }

    /**
     * Execute the command.  Must return the Command Response object
     *
     * @return mixed
     */
    public function execute()
    {
        throw new CommandNotImplementedException('This command has not been implemented yet.');
    }
}
