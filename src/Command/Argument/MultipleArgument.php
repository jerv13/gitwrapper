<?php
/**
 * Multiple Argument
 *
 * This file contains the Multiple Argument for Commands
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
 * Multiple Argument
 *
 * Multiple Argument.
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
trait MultipleArgument
{
    protected $multiple = false;

    /**
     * Allow several <repository> and <group> arguments to be specified.
     * No <refspec>s may be specified.
     *
     * @return $this
     */
    public function multiple()
    {
        $this->multiple = !$this->multiple;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getMultiple()
    {
        $cmd = '';

        if ($this->multiple) {
            $cmd .= ' --multiple';
        }

        return $cmd;
    }
}
