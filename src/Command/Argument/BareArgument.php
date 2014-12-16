<?php
/**
 * Bare Argument
 *
 * This file contains the Bare Argument for Commands
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
 * Bare Argument
 *
 * Bare Argument.
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
trait BareArgument
{
    protected $bare = false;

    /**
     * Create a bare repository.
     *
     * @return $this
     */
    public function bare()
    {
        $this->bare = !$this->bare;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getBare()
    {
        $cmd = '';

        if ($this->bare) {
            $cmd .= ' --bare';
        }

        return $cmd;
    }
}
