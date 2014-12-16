<?php

/**
 * Verbose Argument
 *
 * This file contains the Verbose Argument for Commands
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
 * Verbose Argument
 *
 * Verbose Argument.
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
trait VerboseArgument
{
    protected $verbose = false;

    /**
     * Run verbosely. Does not affect the reporting of progress status to
     * the standard error stream.
     *
     * @return $this
     */
    public function verbose()
    {
        $this->verbose = !$this->verbose;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getVerbose()
    {
        $cmd = '';

        if ($this->verbose) {
            $cmd .= ' --verbose';
        }

        return $cmd;
    }
}
