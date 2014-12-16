<?php
/**
 * Branch Argument
 *
 * This file contains the Branch Argument for Commands
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
 * Branch Argument
 *
 * Branch Argument.
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
trait BranchArgument
{
    protected $branch = '';

    /**
     * Instead of pointing the newly created HEAD to the branch pointed to
     * by the cloned repository's HEAD, point to <name> branch instead. In
     * a non-bare repository, this is the branch that will be checked out.
     * --branch can also take tags and detaches the HEAD at that commit in
     * the resulting repository.
     *
     * @param string $name Name of branch to checkout after clone
     *
     * @return $this
     */
    public function branch($name)
    {
        if (empty($name)) {
            $name = '';
        }

        $this->branch = $name;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getBranch()
    {
        $cmd = '';

        if (!empty($this->branch)) {
            $cmd .= ' --branch='.escapeshellarg($this->branch);
        }

        return $cmd;
    }
}
