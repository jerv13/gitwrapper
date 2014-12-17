<?php
/**
 * RefMap Argument
 *
 * This file contains the RefMap Argument for Commands
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
 * RefMap Argument
 *
 * RefMap Argument.
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
trait RefMapArgument
{
    protected $refMap = '';

    /**
     * When fetching refs listed on the command line, use the specified
     * refspec (can be given more than once) to map the refs to
     * remote-tracking branches, instead of the values of remote.*.fetch
     * configuration variables for the remote repository. See section on
     * "Configured Remote-tracking Branches" for details.
     *
     * @param string $refspec refspec
     *
     * @return $this
     */
    public function refMap($refspec)
    {
        if (empty($refspec)) {
            $refspec = '';
        }

        $this->refMap = $refspec;
        return $this;
    }


    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getRefMap()
    {
        $cmd = '';

        if ($this->refMap) {
            $cmd .= ' --refmap='.escapeshellarg($this->refMap);
        }

        return $cmd;
    }
}
