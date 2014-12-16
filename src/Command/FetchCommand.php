<?php

/**
 * Fetch Command
 *
 * This file contains the Fetch Command
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
 * Fetch Command
 *
 * Fetch Command.  Download objects and refs from another repository.
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
class FetchCommand extends CommandAbstract
{
    protected $all                      = false;
    protected $append                   = false;
    protected $depth                    = null;
    protected $unshallow                = false;
    protected $updateShallow            = false;
    protected $dryRun                   = false;
    protected $force                    = false;
    protected $keep                     = false;
    protected $multiple                 = false;
    protected $prune                    = false;
    protected $noTags                   = false;
    protected $refmap                   = array();
    protected $tags                     = false;
    protected $recurseSubmodules        = '';
    protected $noRecurseSubmodules      = false;
    protected $recurseSubmodulesDefault = '';
    protected $updateHeadOk             = false;
    protected $uploadPack               = '';
    protected $quiet                    = false;
    protected $verbose                  = false;
    protected $progress                 = false;

    protected $repository               = '';
    protected $group                    = '';
    protected $refspec                  = '';

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
