<?php
/**
 * NoCheckout Argument
 *
 * This file contains the NoCheckout Argument for Commands
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
 * NoCheckout Argument
 *
 * NoCheckout Argument.
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
trait NoCheckoutArgument
{
    protected $noCheckout = false;

    /**
     * No checkout of HEAD is performed after the clone is complete.
     *
     * @return $this
     */
    public function noCheckout()
    {
        $this->noCheckout = !$this->noCheckout;
        return $this;
    }

    /**
     * Alias of noCheckout
     *
     * @return $this
     */
    public function n()
    {
        return $this->noCheckout();
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getNoCheckout()
    {
        $cmd = '';

        if ($this->noCheckout) {
            $cmd .= ' --no-checkout';
        }

        return $cmd;
    }
}
