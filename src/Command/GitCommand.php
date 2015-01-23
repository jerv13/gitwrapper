<?php

/**
 * Git Command
 *
 * This file contains the Git Command
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

use Reliv\Git\Command\Argument\BareArgument;
use Reliv\Git\Command\Argument\CArgument;
use Reliv\Git\Command\Argument\ExecPathArgument;
use Reliv\Git\Command\Argument\GitDirArgument;
use Reliv\Git\Command\Argument\GlobPathspecsArgument;
use Reliv\Git\Command\Argument\HelpArgument;
use Reliv\Git\Command\Argument\HtmlPathArgument;
use Reliv\Git\Command\Argument\ICasePathspecsArgument;
use Reliv\Git\Command\Argument\InfoPathArgument;
use Reliv\Git\Command\Argument\LiteralPathspecsArgument;
use Reliv\Git\Command\Argument\ManPathArgument;
use Reliv\Git\Command\Argument\NamespaceArgument;
use Reliv\Git\Command\Argument\NoReplaceObjectsArgument;
use Reliv\Git\Command\Argument\PaginateArgument;
use Reliv\Git\Command\Argument\RunInPathArgument;
use Reliv\Git\Command\Argument\VersionArgument;
use Reliv\Git\Command\Argument\WorkTreeArgument;
use Reliv\Git\Exception\InvalidArgumentException;
use Reliv\Git\Exception\MethodNotFoundException;

/**
 * Git Command
 *
 * Git Command.  Parent Command
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
 *
 * @method AddCommand      add()                       Add file contents to the index
 * @method BisectCommand   bisect()                    Find by binary search the change that introduced a bug
 * @method BranchCommand   branch()                    List, create, or delete branches
 * @method CloneCommand    clone($from, $toDir = null) Clone a repository into a new directory
 * @method CommitCommand   commit()                    Record changes to the repository
 * @method DiffCommand     diff()                      Show changes between commits, commit and working tree, etc
 * @method GrepCommand     grep()                      Print lines matching a pattern
 * @method LogCommand      log()                       Show commit logs
 * @method MergeCommand    merge()                     Join two or more development histories together
 * @method MvCommand       mv()                        Move or rename a file, a directory, or a symlink
 * @method PullCommand     pull()                      Fetch from and integrate with another repository
 * @method PushCommand     push()                      Update remote refs along with associated objects
 * @method RebaseCommand   rebase()                    Forward-port local commits to the updated upstream head
 * @method RemoteCommand   remote()                    Manage set of tracked repositories
 * @method ResetCommand    reset()                     Reset current HEAD to the specified state
 * @method RevParseCommand revParse()                  Pick out and massage parameters
 * @method RmCommand       rm()                        Remove files from the working tree and from the index
 * @method ShowCommand     show()                      Show various types of objects
 * @method TagCommand      tag()                       Create, list, delete or verify a tag object signed with GPG
 */
class GitCommand extends CommandAbstract
{
    use VersionArgument;
    use HelpArgument;
    use RunInPathArgument;
    use CArgument;
    use ExecPathArgument;
    use HtmlPathArgument;
    use ManPathArgument;
    use InfoPathArgument;
    use PaginateArgument;
    use GitDirArgument;
    use WorkTreeArgument;
    use NamespaceArgument;
    use BareArgument;
    use NoReplaceObjectsArgument;
    use LiteralPathspecsArgument;
    use GlobPathspecsArgument;
    use ICasePathspecsArgument;

    protected $executable;

    /**
     * Constructor
     *
     * @param string $executable Path to Git Executable
     */
    public function __construct($executable)
    {
        if (!is_executable($executable)) {
            throw new InvalidArgumentException('Git command not found or is not executable by current user.');
        }

        $this->executable = $executable;
    }

    /**
     * Magic method to get child commands.  See class documentation for the list of current supported commands.
     *
     * @param string $name      Name of method
     * @param array  $arguments Array of arguments to pass to the class constructor
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        /* Fix for clone reserved word issue */
        if ($name == 'clone') {
            return call_user_func(array($this, 'cloneFrom'), $arguments);
        }

        $name = ucfirst($name);
        $class = __NAMESPACE__.'\\'.$name.'Command';

        if (!class_exists($class)) {
            throw new MethodNotFoundException(
                sprintf(
                    'Call to undefined function: %s::%s().',
                    get_class($this),
                    $name
                )
            );
        }

        return new $class($this, $arguments);
    }

    /*
     * Defined Sub-Commands
     */

    /**
     * Clone a repository into a new directory
     *
     * @param string $from  URI to Git repo to clone
     * @param string $toDir Directory to clone to.
     *
     * @return CloneCommand
     */
    public function cloneFrom($from, $toDir = null)
    {
        return new CloneCommand($this, $from, $toDir);
    }

    /**
     * Create an empty Git repository or reinitialize an existing one
     *
     * @param string $path Directory path for new or existing repository
     *
     * @return InitCommand
     */
    public function init($path = null)
    {
        if ($path) {
            $this->runInPath($path);
        }

        return new InitCommand($this);
    }

    /**
     * Show the working tree status
     *
     * @param null $pathspecs Pathspecs
     *
     * @return StatusCommand
     */
    public function status($pathspecs = null)
    {
        return new StatusCommand($this, $pathspecs);
    }

    /**
     * Download objects and refs from another repository
     *
     * @param string|null $repositoryOrGroup Repository path/url or group name
     * @param string|null $refspec           Refspec.  Do not use when fetching a group.
     *
     * @return FetchCommand
     */
    public function fetch(
        $repositoryOrGroup = null,
        $refspec = null
    ) {
        return new FetchCommand($this, $repositoryOrGroup, $refspec);
    }

    /**
     * List references in a remote repository
     *
     * @param null|string $repository The "remote" repository to query. This parameter can be either a URL or
     *                                the name of a remote (see the GIT URLS and REMOTES sections of
     *                                git-fetch(1)).
     * @param null|string $refs       When unspecified, all references, after filtering done with --heads
     *                                and --tags, are shown. When <refs>... are specified, only
     *                                references matching the given patterns are displayed.
     *
     * @return LsRemoteCommand
     */
    public function lsRemote(
        $repository = null,
        $refs = null
    ) {
        return new LsRemoteCommand($this, $repository, $refs);
    }

    /**
     * Checkout a branch or paths to the working tree
     *
     * @param string $branchOrCommit Branch or Commit
     *
     * @return CheckoutCommand
     */
    public function checkout($branchOrCommit)
    {
        return new CheckoutCommand($this, $branchOrCommit);
    }

    /*
     * GetCommand
     */

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = $this->executable;
        $cmd .= $this->getVersion();
        $cmd .= $this->getHelp();
        $cmd .= $this->getRunInPath();
        $cmd .= $this->getC();
        $cmd .= $this->getExecPath();
        $cmd .= $this->getHtmlPath();
        $cmd .= $this->getManPath();
        $cmd .= $this->getInfoPath();
        $cmd .= $this->getPaginate();
        $cmd .= $this->getGitDir();
        $cmd .= $this->getWorkTree();
        $cmd .= $this->getNamespace();
        $cmd .= $this->getBare();
        $cmd .= $this->getNoReplaceObjects();
        $cmd .= $this->getLiteralPathspecs();
        $cmd .= $this->getGlobPathspecs();
        $cmd .= $this->getICasePathspecs();

        return $cmd;
    }
}
