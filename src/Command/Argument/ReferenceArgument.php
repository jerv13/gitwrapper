<?php
/**
 * Reference Argument
 *
 * This file contains the Reference Argument for Commands
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
 * Reference Argument
 *
 * Reference Argument.
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
trait ReferenceArgument
{
    protected $reference = '';

    /**
     * If the reference repository is on the local machine, automatically
     * setup .git/objects/info/alternates to obtain objects from the
     * reference repository. Using an already existing repository as an
     * alternate will require fewer objects to be copied from the
     * repository being cloned, reducing network and local storage costs.
     *
     * NOTE: see the NOTE for the --shared option.
     *
     * @param string $repository Local Repository
     *
     * @return $this
     */
    public function reference($repository)
    {
        if (empty($repository)) {
            $repository = '';
        }

        $this->reference = $repository;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getReference()
    {
        $cmd = '';

        if (!empty($this->reference)) {
            $cmd .= ' --reference='.escapeshellarg($this->reference);
        }

        return $cmd;
    }
}
