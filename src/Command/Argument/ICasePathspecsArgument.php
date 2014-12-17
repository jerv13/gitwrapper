<?php
/**
 * ICasePathspecs Argument
 *
 * This file contains the ICasePathspecs Argument for Commands
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
 * ICasePathspecs Argument
 *
 * ICasePathspecs Argument.
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
trait ICasePathspecsArgument
{
    protected $iCasePathspecs = false;

    /**
     * Add "icase" magic to all pathspec. This is equivalent to setting
     * the GIT_ICASE_PATHSPECS environment variable to 1.
     *
     * @return $this
     */
    public function iCasePathspecs()
    {
        $this->iCasePathspecs = !$this->iCasePathspecs;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getICasePathspecs()
    {
        $cmd = '';

        if ($this->iCasePathspecs) {
            $cmd .= ' --icase-pathspecs';
        }

        return $cmd;
    }
}
