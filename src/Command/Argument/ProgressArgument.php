<?php
/**
 * Progress Argument
 *
 * This file contains the Progress Argument for Commands
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
 * Progress Argument
 *
 * Progress Argument.
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
trait ProgressArgument
{
    protected $progress = false;

    /**
     * Progress status is reported on the standard error stream by default
     * when it is attached to a terminal, unless -q is specified. This
     * flag forces progress status even if the standard error stream is
     * not directed to a terminal.
     *
     * @return $this
     */
    public function progress()
    {
        $this->progress = !$this->progress;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getProgress()
    {
        $cmd = '';

        if ($this->progress) {
            $cmd .= ' --progress';
        }

        return $cmd;
    }
}
