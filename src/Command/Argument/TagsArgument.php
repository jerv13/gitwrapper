<?php
/**
 * Tags Argument
 *
 * This file contains the Tags Argument for Commands
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
 * Tags Argument
 *
 * Tags Argument.
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
trait TagsArgument
{
    protected $tags   = false;
    protected $noTags = false;

    /**
     * Fetch all tags from the remote (i.e., fetch remote tags refs/tags/*
     * into local tags with the same name), in addition to whatever else
     * would otherwise be fetched. Using this option alone does not
     * subject tags to pruning, even if --prune is used (though tags may
     * be pruned anyway if they are also the destination of an explicit
     * refspec; see --prune).
     *
     * @return $this
     */
    public function tags()
    {
        $this->tags = !$this->tags;
        $this->noTags = !$this->tags;
        return $this;
    }

    /**
     * Alias of Tags
     *
     * @return $this
     */
    public function t()
    {
        return $this->tags();
    }

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
        $this->tags = !$this->noTags;
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
    public function getTags()
    {
        $cmd = '';

        if ($this->tags) {
            $cmd .= ' --tags';
        }

        if ($this->noTags) {
            $cmd .= ' --no-tags';
        }

        return $cmd;
    }
}
