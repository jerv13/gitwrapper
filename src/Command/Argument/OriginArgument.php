<?php
/**
 * Origin Argument
 *
 * This file contains the Origin Argument for Commands
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
 * Origin Argument
 *
 * Origin Argument.
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
trait OriginArgument
{
    protected $origin = 'origin';

    /**
     * Instead of using the remote name origin to keep track of the
     * upstream repository, use <name>.
     *
     * @param string $name Alternate name for origin
     *
     * @return $this
     */
    public function origin($name)
    {
        if (empty($name) || strtolower($name) == 'origin') {
            $name = 'origin';
        }

        $this->origin = $name;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getOrigin()
    {
        $cmd = '';

        if (!empty($this->origin) && $this->origin != 'origin') {
            $cmd .= ' --origin='.escapeshellarg($this->origin);
        }

        return $cmd;
    }
}
