<?php
/**
 * Namespace Argument
 *
 * This file contains the Namespace Argument for Commands
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
 * Namespace Argument
 *
 * Namespace Argument.
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
trait NamespaceArgument
{
    protected $namespace = '';

    /**
     * Set the Git namespace. See gitnamespaces(7) for more details.
     * Equivalent to setting the GIT_NAMESPACE environment variable.
     *
     * @param string $namespace Namespace
     *
     * @return $this
     */
    public function setNamespace($namespace)
    {
        if (!empty($namespace) && !is_string($namespace)) {
            throw new InvalidArgumentException('Namespace must be passed in as a string');
        }

        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getNamespace()
    {
        $cmd = '';

        if (!empty($this->namespace)) {
            $cmd .= ' --namespace='.escapeshellarg($this->namespace);
        }

        return $cmd;
    }
}
