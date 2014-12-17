<?php
/**
 * UpdateShallow Argument
 *
 * This file contains the UpdateShallow Argument for Commands
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
 * UpdateShallow Argument
 *
 * UpdateShallow Argument.
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
trait UpdateShallowArgument
{
    protected $updateShallow = false;

    /**
     * By default when fetching from a shallow repository, git fetch
     * refuses refs that require updating .git/shallow. This option
     * updates .git/shallow and accept such refs.
     *
     * @return $this
     */
    public function updateShallow()
    {
        $this->updateShallow = !$this->updateShallow;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getUpdateShallow()
    {
        $cmd = '';

        if ($this->updateShallow) {
            $cmd .= ' --update-shallow';
        }

        return $cmd;
    }
}
