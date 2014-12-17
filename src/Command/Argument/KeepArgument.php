<?php
/**
 * Keep Argument
 *
 * This file contains the Keep Argument for Commands
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
 * Keep Argument
 *
 * Keep Argument.
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
trait KeepArgument
{
    protected $keep = false;

    /**
     * Keep downloaded pack.
     *
     * @return $this
     */
    public function keep()
    {
        $this->keep = !$this->keep;
        return $this;
    }

    /**
     * Alias of Keep
     *
     * @return $this
     */
    public function k()
    {
        return $this->keep();
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getKeep()
    {
        $cmd = '';

        if ($this->keep) {
            $cmd .= ' --keep';
        }

        return $cmd;
    }
}
