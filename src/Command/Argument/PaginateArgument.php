<?php
/**
 * Paginate Argument
 *
 * This file contains the Paginate Argument for Commands
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
 * Paginate Argument
 *
 * Paginate Argument.
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
trait PaginateArgument
{
    protected $paginate = false;
    protected $noPager = false;

    /**
     * Pipe all output into less (or if set, $PAGER) if standard output is
     * a terminal. This overrides the pager.<cmd> configuration options
     * (see the "Configuration Mechanism" section below).
     *
     * @return $this
     */
    public function paginate()
    {
        $this->paginate = !$this->paginate;
        $this->noPager = !$this->paginate;
        return $this;
    }

    /**
     * Do not pipe Git output into a pager.
     *
     * @return $this
     */
    public function noPager()
    {
        $this->noPager = !$this->noPager;
        $this->paginate = !$this->noPager;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getPaginate()
    {
        $cmd = '';

        if ($this->paginate) {
            $cmd .= ' --paginate';
        }

        if ($this->noPager) {
            $cmd .= ' --no-pager';
        }

        return $cmd;
    }
}
