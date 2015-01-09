<?php
/**
 * No Tags Argument
 *
 * This file contains the No Tags Argument for Commands
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
 * No Tags Argument
 *
 * No Tags Argument.
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
trait NoTagsArgument
{
    protected $noTags = false;

    /**
     * By default, tags that point at objects that are downloaded from the
     * remote repository are fetched and stored locally. This option
     * disables this automatic tag following. The default behavior for a
     * remote may be specified with the remote.<name>.tagopt setting. See
     * git-config(1).
     *
     * @return $this
     */
    public function noTags()
    {
        $this->noTags = !$this->noTags;
        return $this;
    }

    /**
     * Alias of noTags
     *
     * @return $this
     */
    public function n()
    {
        return $this->noTags();
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getNoTags()
    {
        $cmd = '';

        if ($this->noTags) {
            $cmd .= ' --no-tags';
        }

        return $cmd;
    }
}
