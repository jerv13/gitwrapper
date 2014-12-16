<?php
/**
 * Depth Argument
 *
 * This file contains the Depth Argument for Commands
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
 * Depth Argument
 *
 * Depth Argument.  Create a shallow clone with a history truncated to the specified number of revisions.
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

trait DepthArgument
{
    protected $depth = null;

    /**
     * Create a shallow clone with a history truncated to the specified
     * number of revisions.
     *
     * @param integer $depth Number of revisions to limit clone by.
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function depth($depth)
    {
        if (!empty($depth) && !is_numeric($depth)) {
            throw new InvalidArgumentException(
                'Only numeric values can be used when setting the depth of a clone.'
            );
        } elseif (empty($depth)) {
            $depth = null;
        }

        $this->depth = $depth;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getDepth()
    {
        $cmd = '';

        if ($this->depth) {
            $cmd .= ' --depth='.escapeshellarg($this->depth);
        }

        return $cmd;
    }
}
