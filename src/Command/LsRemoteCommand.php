<?php

/**
 * LsRemote Command
 *
 * This file contains the LsRemote Command
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

namespace Reliv\Git\Command;

use Reliv\Git\Command\Argument\ExitCodeArgument;
use Reliv\Git\Command\Argument\HeadsArgument;
use Reliv\Git\Command\Argument\TagsArgument;
use Reliv\Git\Command\Argument\UploadPackArgument;
use Reliv\Git\Exception\InvalidArgumentException;

/**
 * LsRemote Command
 *
 * LsRemote Command.  LsRemote file contents to the index
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
class LsRemoteCommand extends CommandAbstract
{
    use UploadPackArgument;
    use HeadsArgument;
    use TagsArgument;
    use ExitCodeArgument;

    protected $repository = '';
    protected $refs = '';

    /**
     * Constructor
     *
     * @param CommandInterface $parent     Command to wrap
     * @param null|string      $repository The "remote" repository to query. This parameter can be either a URL or
     *                                     the name of a remote (see the GIT URLS and REMOTES sections of
     *                                     git-fetch(1)).
     * @param null|string      $refs       When unspecified, all references, after filtering done with --heads
     *                                     and --tags, are shown. When <refs>... are specified, only
     *                                     references matching the given patterns are displayed.
     */
    public function __construct(
        CommandInterface $parent,
        $repository = null,
        $refs = null
    ) {

        parent::__construct($parent);

        if ((!empty($repository) && !is_string($repository)) || is_array($repository)) {
            throw new InvalidArgumentException(
                'Repository must be a string'
            );
        }

        if ((!empty($refs) && !is_string($refs)) || is_array($refs)) {
            throw new InvalidArgumentException(
                'Refs must be a string'
            );
        }

        $this->repository = $repository;
        $this->refs = $refs;
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' ls-remote';
        $cmd .= $this->getHeads();
        $cmd .= $this->getTags();
        $cmd .= $this->getExitCode();

        $cmd .= $this->getUploadPack();

        if ($this->repository) {
            $cmd .= ' '.escapeshellarg($this->repository);
        }

        if ($this->repository && $this->refs) {
            $cmd .= ' '.escapeshellarg($this->refs);
        }

        return $cmd;
    }
}
