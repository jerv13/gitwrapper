<?php

/**
 * Branch Command
 *
 * This file contains the Branch Command
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

/**
 * Branch Command
 *
 * Branch Command.  List, create, or delete branches
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
class BranchCommand extends CommandAbstract
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
