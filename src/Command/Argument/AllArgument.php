<?php
/**
 * All Argument
 *
 * This file contains the All Argument for Commands
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
 * All Argument
 *
 * All Argument.
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
trait AllArgument
{
    protected $all = false;

    /**
     * Fetch all remotes.
     *
     * @return $this
     */
    public function all()
    {
        $this->all = !$this->all;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getAll()
    {
        $cmd = '';

        if ($this->all) {
            $cmd .= ' --all';
        }

        return $cmd;
    }
}
