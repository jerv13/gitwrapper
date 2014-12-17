<?php
/**
 * RecurseSubmodules Argument
 *
 * This file contains the RecurseSubmodules Argument for Commands
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

use Reliv\Git\Exception\InvalidArgumentException;

/**
 * RecurseSubmodules Argument
 *
 * RecurseSubmodules Argument.
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
trait RecurseSubmodulesArgument
{
    protected $recurseSubmodules   = '';
    protected $noRecurseSubmodules = false;

    /**
     * This option controls if and under what conditions new commits of
     * populated submodules should be fetched too. It can be used as a
     * boolean option to completely disable recursion when set to no or to
     * unconditionally recurse into all populated submodules when set to
     * yes, which is the default when this option is used without any
     * value. Use on-demand to only recurse into a populated submodule
     * when the superproject retrieves a commit that updates the
     * submodule's reference to a commit that isn't already in the local
     * submodule clone.
     *
     * @param string|boolean $option Accepted Values: true, false, 'yes', 'no', 'on-demand'
     *
     * @return $this
     */
    public function recurseSubmodules($option = true)
    {
        if ($option === true) {
            $option = 'yes';
        } elseif ($option === false) {
            $option = 'no';
        }

        $option = strtolower($option);

        $allowed = array(
            'yes',
            'no',
            'on-demand'
        );

        if (!empty($option) && !in_array($option, $allowed)) {
            throw new InvalidArgumentException(
                'Invalid argument for recurseSubmodules() allowed values: true, false, \'yes\', \'no\', \'on-demand\''
            );
        }

        $this->recurseSubmodules = $option;
        return $this;
    }

    /**
     * Disable recursive fetching of submodules (this has the same effect
     * as using the --recurse-submodules=no option).
     *
     * @return $this
     */
    public function noRecurseSubmodules()
    {
        $this->noRecurseSubmodules = !$this->noRecurseSubmodules;
        $this->recurseSubmodules = '';
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getRecurseSubmodules()
    {
        $cmd = '';

        if ($this->recurseSubmodules) {
            $cmd .= ' --recurse-submodules='.escapeshellarg($this->recurseSubmodules);
        }

        if ($this->noRecurseSubmodules) {
            $cmd .= ' --no-recurse-submodules';
        }

        return $cmd;
    }
}
