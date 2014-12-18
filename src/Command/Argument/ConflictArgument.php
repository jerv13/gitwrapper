<?php
/**
 * Conflict Argument
 *
 * This file contains the Conflict Argument for Commands
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
 * Conflict Argument
 *
 * Conflict Argument.
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
trait ConflictArgument
{
    protected $conflict = '';

    /**
     * The same as --merge option above, but changes the way the
     * conflicting hunks are presented, overriding the merge.conflictstyle
     * configuration variable. Possible values are "merge" (default) and
     * "diff3" (in addition to what is shown by "merge" style, shows the
     * original contents).
     *
     * @param string $value Possible values: merge, diff3
     *
     * @return $this
     */
    public function conflict($value = 'merge')
    {
        $allowed = array(
            'merge',
            'diff3',
        );

        $value = strtolower($value);

        if (!empty($value) && !in_array($value, $allowed)) {
            throw new InvalidArgumentException(
                'Invalid option passed for conflict.  Available'
                .' options: merge, diff3'
            );
        }

        $this->conflict = $value;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getConflict()
    {
        $cmd = '';

        if ($this->conflict) {
            $cmd .= ' --conflict='.escapeshellarg($this->conflict);
        }

        return $cmd;
    }
}
