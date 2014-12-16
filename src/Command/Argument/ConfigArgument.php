<?php
/**
 * Config Argument
 *
 * This file contains the Config Argument for Commands
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
 * Config Argument
 *
 * Config Argument.
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
trait ConfigArgument
{
    protected $config = array();

    /**
     * Set a configuration variable in the newly-created repository; this
     * takes effect immediately after the repository is initialized, but
     * before the remote history is fetched or any files checked out. The
     * key is in the same format as expected by git-config(1) (e.g.,
     * core.eol=true). If multiple values are given for the same key, each
     * value will be written to the config file. This makes it safe, for
     * example, to add additional fetch refspecs to the origin remote.
     *
     * Values should be passed as key value pairs. example:
     * <code>
     * array(
     *    'myKey' => 'myValue',
     *    'myKey2' => 'myValue2'
     * )
     * </code>
     *
     * @param array $options Array of key value pairs.
     *
     * @return $this
     *
     * @todo Create a validator for config options.  Currently we just pass the values through to git and let it fail.
     */
    public function config(Array $options)
    {
        $this->config = $options;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getConfig()
    {
        $cmd = '';

        if (!empty($this->config) && is_array($this->config)) {
            foreach ($this->config as $configKey => $configValue) {
                $cmd .= ' --config '
                    .escapeshellarg($configKey).'='
                    .escapeshellarg($configValue);
            }
        }

        return $cmd;
    }
}
