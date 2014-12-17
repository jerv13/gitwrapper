<?php
/**
 * Prune Argument
 *
 * This file contains the Prune Argument for Commands
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
 * Prune Argument
 *
 * Prune Argument.
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
trait PruneArgument
{
    protected $prune = false;

    /**
     * After fetching, remove any remote-tracking references that no
     * longer exist on the remote. Tags are not subject to pruning if they
     * are fetched only because of the default tag auto-following or due
     * to a --tags option. However, if tags are fetched due to an explicit
     * refspec (either on the command line or in the remote configuration,
     * for example if the remote was cloned with the --mirror option),
     * then they are also subject to pruning.
     *
     * @return $this
     */
    public function prune()
    {
        $this->prune = !$this->prune;
        return $this;
    }

    /**
     * Alias of Prune
     *
     * @return $this
     */
    public function p()
    {
        return $this->prune();
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getPrune()
    {
        $cmd = '';

        if ($this->prune) {
            $cmd .= ' --prune';
        }

        return $cmd;
    }
}
