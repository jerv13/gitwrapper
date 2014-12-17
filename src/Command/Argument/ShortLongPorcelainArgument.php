<?php
/**
 * ShortLongPorcelain Argument
 *
 * This file contains the ShortLongPorcelain Argument for Commands
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
 * ShortLongPorcelain Argument
 *
 * ShortLongPorcelain Argument.
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
trait ShortLongPorcelainArgument
{
    protected $short     = false;
    protected $long      = false;
    protected $porcelain = false;

    /**
     * Give the output in the short-format.
     *
     * @return $this
     */
    public function short()
    {
        $this->short = !$this->short;
        $this->porcelain = !$this->short;
        $this->long = !$this->short;
        return $this;
    }

    /**
     * Alias of short
     *
     * @return $this
     */
    public function s()
    {
        return $this->short();
    }

    /**
     * Give the output in an easy-to-parse format for scripts. This is
     * similar to the short output, but will remain stable across Git
     * versions and regardless of user configuration. See below for
     * details.
     *
     * @return $this
     */
    public function porcelain()
    {
        $this->porcelain = !$this->porcelain;
        $this->short = !$this->porcelain;
        $this->long = !$this->porcelain;
        return $this;
    }

    /**
     * Give the output in the long-format. This is the default.
     *
     * @return $this
     */
    public function long()
    {
        $this->long = !$this->long;
        $this->short = !$this->long;
        $this->porcelain = !$this->long;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getShortLongPorcelain()
    {
        $cmd = '';

        if ($this->short) {
            $cmd .= ' --short';
        }

        if ($this->porcelain) {
            $cmd .= ' --porcelain';
        }

        if ($this->long) {
            $cmd .= ' --long';
        }

        return $cmd;
    }
}
