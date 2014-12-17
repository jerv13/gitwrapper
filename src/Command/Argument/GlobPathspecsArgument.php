<?php
/**
 * GlobPathspecs Argument
 *
 * This file contains the GlobPathspecs Argument for Commands
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
 * GlobPathspecs Argument
 *
 * GlobPathspecs Argument.
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
trait GlobPathspecsArgument
{
    protected $globPathspecs = false;
    protected $noGlobPathspecs = false;

    /**
     * Add "glob" magic to all pathspec. This is equivalent to setting the
     * GIT_GLOB_PATHSPECS environment variable to 1. Disabling globbing on
     * individual pathspecs can be done using pathspec magic ":(literal)"
     *
     * @return $this
     */
    public function globPathspecs()
    {
        $this->globPathspecs   = !$this->globPathspecs;
        $this->noGlobPathspecs = !$this->globPathspecs;
        return $this;
    }

    /**
     * Add "literal" magic to all pathspec. This is equivalent to setting
     * the GIT_NOGLOB_PATHSPECS environment variable to 1. Enabling
     * globbing on individual pathspecs can be done using pathspec magic
     * ":(glob)"
     *
     * @return $this
     */
    public function noGlobPathspecs()
    {
        $this->noGlobPathspecs = !$this->noGlobPathspecs;
        $this->globPathspecs   = !$this->noGlobPathspecs;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getGlobPathspecs()
    {
        $cmd = '';

        if ($this->globPathspecs) {
            $cmd .= ' --glob-pathspecs';
        }

        if ($this->noGlobPathspecs) {
            $cmd .= ' --noglob-pathspecs';
        }

        return $cmd;
    }
}
