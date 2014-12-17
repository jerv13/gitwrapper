<?php
/**
 * DryRun Argument
 *
 * This file contains the DryRun Argument for Commands
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
 * DryRun Argument
 *
 * DryRun Argument.
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
trait DryRunArgument
{
    protected $dryRun = false;

    /**
     * Show what would be done, without making any changes.
     *
     * @return $this
     */
    public function dryRun()
    {
        $this->dryRun = !$this->dryRun;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getDryRun()
    {
        $cmd = '';

        if ($this->dryRun) {
            $cmd .= ' --dry-run';
        }

        return $cmd;
    }
}
