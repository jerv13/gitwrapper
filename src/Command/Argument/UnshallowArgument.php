<?php
/**
 * Unshallow Argument
 *
 * This file contains the Unshallow Argument for Commands
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
 * Unshallow Argument
 *
 * Unshallow Argument.
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
trait UnshallowArgument
{
    protected $unshallow = false;

    /**
     * If the source repository is complete, convert a shallow repository
     * to a complete one, removing all the limitations imposed by shallow
     * repositories.
     *
     * If the source repository is shallow, fetch as much as possible so
     * that the current repository has the same history as the source
     * repository.
     *
     * @return $this
     */
    public function unshallow()
    {
        $this->unshallow = !$this->unshallow;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getUnshallow()
    {
        $cmd = '';

        if ($this->unshallow) {
            $cmd .= ' --unshallow';
        }

        return $cmd;
    }
}
