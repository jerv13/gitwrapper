<?php
/**
 * Append Argument
 *
 * This file contains the Append Argument for Commands
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
 * Append Argument
 *
 * Append Argument.
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
trait AppendArgument
{
    protected $append = false;

    /**
     * Append ref names and object names of fetched refs to the existing
     * contents of .git/FETCH_HEAD. Without this option old data in
     * .git/FETCH_HEAD will be overwritten.
     *
     * @return $this
     */
    public function append()
    {
        $this->append = !$this->append;
        return $this;
    }

    /**
     * Alias of Append
     *
     * @return $this
     */
    public function a()
    {
        return $this->append();
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getAppend()
    {
        $cmd = '';

        if ($this->append) {
            $cmd .= ' --append';
        }

        return $cmd;
    }
}
