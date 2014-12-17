<?php
/**
 * BranchBoolean Argument
 *
 * This file contains the BranchBoolean Argument for Commands
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
 * BranchBoolean Argument
 *
 * BranchBoolean Argument.
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
trait BranchBooleanArgument
{
    protected $branch = false;

    /**
     * Show the branch and tracking info even in short-format.
     *
     * @return $this
     */
    public function branch()
    {
        $this->branch = !$this->branch;
        return $this;
    }

    /**
     * Alias of Branch
     *
     * @return $this
     */
    public function b()
    {
        return $this->branch();
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getBranch()
    {
        $cmd = '';

        if ($this->branch) {
            $cmd .= ' --branch';
        }

        return $cmd;
    }
}
