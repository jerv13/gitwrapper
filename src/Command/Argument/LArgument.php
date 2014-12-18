<?php
/**
 * L Argument
 *
 * This file contains the L Argument for Commands
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
 * L Argument
 *
 * L Argument.
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
trait LArgument
{
    protected $l = false;

    /**
     * Create the new branch’s reflog; see git-branch[1] for details.
     *
     * @return $this
     */
    public function l()
    {
        $this->l = !$this->l;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getL()
    {
        $cmd = '';

        if ($this->l) {
            $cmd .= ' -l';
        }

        return $cmd;
    }
}
