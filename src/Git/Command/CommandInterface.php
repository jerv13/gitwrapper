<?php

/**
 * Command Interface
 *
 * This file contains the Command Interface
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
 * Command Interface
 *
 * Command Interface
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
interface CommandInterface
{
    /**
     * Get the command string to be used by the CLI
     *
     * @return mixed
     */
    public function getCommand();

    /**
     * Execute the command.  Must return the Command Response object
     *
     * @return mixed
     */
    public function execute();
}
