<?php
/**
 * LiteralPathspecs Argument
 *
 * This file contains the LiteralPathspecs Argument for Commands
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
 * LiteralPathspecs Argument
 *
 * LiteralPathspecs Argument.
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
trait LiteralPathspecsArgument
{
    protected $literalPathspecs = false;

    /**
     * Treat pathspecs literally (i.e. no globbing, no pathspec magic).
     * This is equivalent to setting the GIT_LITERAL_PATHSPECS environment
     * variable to 1.
     *
     * @return $this
     */
    public function literalPathspecs()
    {
        $this->literalPathspecs = !$this->literalPathspecs;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getLiteralPathspecs()
    {
        $cmd = '';

        if ($this->literalPathspecs) {
            $cmd .= ' --literal-pathspecs';
        }

        return $cmd;
    }
}
