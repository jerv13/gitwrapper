<?php
/**
 * NoReplaceObjects Argument
 *
 * This file contains the NoReplaceObjects Argument for Commands
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
 * NoReplaceObjects Argument
 *
 * NoReplaceObjects Argument.
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
trait NoReplaceObjectsArgument
{
    protected $noReplaceObjects = false;

    /**
     * Do not use replacement refs to replace Git objects.
     *
     * @return $this
     */
    public function noReplaceObjects()
    {
        $this->noReplaceObjects = !$this->noReplaceObjects;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getNoReplaceObjects()
    {
        $cmd = '';

        if ($this->noReplaceObjects) {
            $cmd .= ' --no-replace-objects';
        }

        return $cmd;
    }
}
