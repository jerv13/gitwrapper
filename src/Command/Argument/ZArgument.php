<?php
/**
 * Z Argument
 *
 * This file contains the Z Argument for Commands
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
 * Z Argument
 *
 * Z Argument.
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
trait ZArgument
{
    protected $z = false;

    /**
     * Terminate entries with NUL, instead of LF. This implies the
     * --porcelain output format if no other format is given.
     *
     * @return $this
     */
    public function z()
    {
        $this->z = !$this->z;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getZ()
    {
        $cmd = '';

        if ($this->z) {
            $cmd .= ' -z';
        }

        return $cmd;
    }
}
