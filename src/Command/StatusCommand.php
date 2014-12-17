<?php

/**
 * Status Command
 *
 * This file contains the Status Command
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

use Reliv\Git\Command\Argument\BranchBooleanArgument;
use Reliv\Git\Command\Argument\ColumnArgument;
use Reliv\Git\Command\Argument\IgnoredArgument;
use Reliv\Git\Command\Argument\IgnoreSubmodulesArgument;
use Reliv\Git\Command\Argument\ShortLongPorcelainArgument;
use Reliv\Git\Command\Argument\UntrackedFilesArgument;
use Reliv\Git\Command\Argument\ZArgument;
use Reliv\Git\Exception\InvalidArgumentException;

/**
 * Status Command
 *
 * Displays paths that have differences between the index file and the
 * current HEAD commit, paths that have differences between the working
 * tree and the index file, and paths in the working tree that are not
 * tracked by Git (and are not ignored by gitignore(5)). The first are
 * what you would commit by running git commit; the second and third are
 * what you could commit by running git add before running git commit.
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
class StatusCommand extends CommandAbstract
{
    use ShortLongPorcelainArgument;
    use BranchBooleanArgument;
    use UntrackedFilesArgument;
    use IgnoreSubmodulesArgument;
    use IgnoredArgument;
    use ZArgument;
    use ColumnArgument;

    protected $pathspec = false;

    /**
     * Constructor.
     *
     * @param CommandInterface $parent    Command to wrap
     * @param string           $pathspecs Pathspecs
     */
    public function __construct(CommandInterface $parent, $pathspecs = null)
    {
        $this->wrappedCommand = $parent;

        if ($pathspecs && is_string($pathspecs)) {
            $this->pathspec = $pathspecs;
        }
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' status';
        $cmd .= $this->getShortLongPorcelain();
        $cmd .= $this->getBranch();
        $cmd .= $this->getUntrackedFiles();
        $cmd .= $this->getIgnoreSubmodules();
        $cmd .= $this->getIgnored();
        $cmd .= $this->getZ();
        $cmd .= $this->getColumn();

        if ($this->pathspec) {
            $cmd .= ' -- '.escapeshellarg($this->pathspec);
        }

        return $cmd;
    }
}
