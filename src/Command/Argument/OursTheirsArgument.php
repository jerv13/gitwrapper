<?php
/**
 * OursTheirs Argument
 *
 * This file contains the OursTheirs Argument for Commands
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
 * OursTheirs Argument
 *
 * OursTheirs Argument.
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
trait OursTheirsArgument
{
    protected $ours   = false;
    protected $theirs = false;

    /**
     * When checking out paths from the index, check out stage #2 (ours) for unmerged paths.
     *
     * @return $this
     */
    public function ours()
    {
        $this->ours   = !$this->ours;
        $this->theirs = false;

        return $this;
    }

    /**
     *  When checking out paths from the index, check out stage #3 (theirs) for unmerged paths.
     *
     * @return $this
     */
    public function theirs()
    {
        $this->theirs = !$this->theirs;
        $this->ours = false;

        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getOursTheirs()
    {
        $cmd = '';

        if ($this->ours) {
            $cmd .= ' --ours';
        }

        if ($this->theirs) {
            $cmd .= ' --theirs';
        }

        return $cmd;
    }
}
