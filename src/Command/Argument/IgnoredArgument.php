<?php
/**
 * Ignored Argument
 *
 * This file contains the Ignored Argument for Commands
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
 * Ignored Argument
 *
 * Ignored Argument.
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
trait IgnoredArgument
{
    protected $ignored = false;

    /**
     * Show ignored files as well.
     *
     * @return $this
     */
    public function ignored()
    {
        $this->ignored = !$this->ignored;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getIgnored()
    {
        $cmd = '';

        if ($this->ignored) {
            $cmd .= ' --ignored';
        }

        return $cmd;
    }
}
