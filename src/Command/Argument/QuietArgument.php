<?php
/**
 * Quiet Argument
 *
 * This file contains the Quiet Argument for Commands
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
 * Quiet Argument
 *
 * Quiet Argument.
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
trait QuietArgument
{
    protected $quiet = false;

    /**
     * Operate quietly. Progress is not reported to the standard error
     * stream. This flag is also passed to the `rsync' command when given.
     *
     * @return $this
     */
    public function quiet()
    {
        $this->quiet = !$this->quiet;
        return $this;
    }

    /**
     * Alias of Quiet
     *
     * @return $this
     */
    public function q()
    {
        return $this->quiet();
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getQuiet()
    {
        $cmd = '';

        if ($this->quiet) {
            $cmd .= ' --quiet';
        }

        return $cmd;
    }
}
