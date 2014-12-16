<?php
/**
 * C Argument
 *
 * This file contains the C Argument for Commands
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
 * C Argument
 *
 * C Argument.
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
trait CArgument
{
    protected $c = array();

    /**
     * Pass a configuration parameter to the command. The value given will
     * override values from configuration files. The <name> is expected in
     * the same format as listed by git config (subkeys separated by
     * dots).
     *
     * Array passed to this method must be in the following format:
     * <code>
     *     array( $configName => $configValue, $configNameTwo => $configValueTwo, ect...)
     * </code>
     *
     * @param array $configuration Array of config values to pass.  array($configname => $value)
     *
     * @return $this
     */
    public function c(Array $configuration)
    {
        $this->c = $configuration;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getC()
    {
        $cmd = '';

        if (!empty($this->c) && is_array($this->c)) {
            foreach ($this->c as $configKey => $configValue) {

                if (empty($configValue)) {
                    $configValue = 'false';
                }

                $cmd .= ' -c '.escapeshellarg($configKey).'='.escapeshellarg($configValue);
            }
        }

        return $cmd;
    }
}
