<?php

/**
 * Command Abstract
 *
 * This file contains the Command Abstract
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
 * Command Abstract
 *
 * Command Abstract.  Common methods used by all commands
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
abstract class CommandAbstract implements CommandInterface
{
    /**
     * @var string Command to execute
     */
    protected $wrappedCommand;

    /**
     * Constructor.
     *
     * @param CommandInterface $command Command to wrap
     */
    public function __construct(CommandInterface $command)
    {
        $this->wrappedCommand = $command->getCommand();
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return mixed
     */
    abstract public function getCommand();


    /**
     * Execute the command.  Must return the Command Response object
     *
     * @return mixed
     */
    public function execute()
    {

    }
}
