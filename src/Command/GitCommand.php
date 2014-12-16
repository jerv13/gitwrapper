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

use Reliv\Git\Command\Argument\CArgument;
use Reliv\Git\Command\Argument\ExecPathArgument;
use Reliv\Git\Command\Argument\HelpArgument;
use Reliv\Git\Command\Argument\HtmlPathArgument;
use Reliv\Git\Command\Argument\InfoPathArgument;
use Reliv\Git\Command\Argument\ManPathArgument;
use Reliv\Git\Command\Argument\PaginateArgument;
use Reliv\Git\Command\Argument\RunInPathArgument;
use Reliv\Git\Command\Argument\VersionArgument;
use Reliv\Git\Exception\DirectoryNotFoundException;
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
 * @method CheckoutCommand checkout()                  Checkout a branch or paths to the working tree
 * @method CloneCommand    clone($from, $toDir = null) Clone a repository into a new directory
 * @method CommitCommand   commit()                    Record changes to the repository
 * @method DiffCommand     diff()                      Show changes between commits, commit and working tree, etc
 * @method FetchCommand    fetch()                     Download objects and refs from another repository
 * @method GrepCommand     grep()                      Print lines matching a pattern
 * @method LogCommand      log()                       Show commit logs
 * @method MergeCommand    merge()                     Join two or more development histories together
 * @method MvCommand       mv()                        Move or rename a file, a directory, or a symlink
 * @method PullCommand     pull()                      Fetch from and integrate with another repository
 * @method PushCommand     push()                      Update remote refs along with associated objects
 * @method RebaseCommand   rebase()                    Forward-port local commits to the updated upstream head
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

    protected $executable;









    protected $gitDir = '';
    protected $workTree = '';
    protected $namespace = '';
    protected $bare = false;
    protected $noReplaceObjects = false;
    protected $literalPathspecs = false;
    protected $globPathspecs = false;
    protected $noGlobPathspecs = false;
    protected $iCasePathspecs = false;


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
            $this->workTree($path);
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

    /*
     * Command Argument and Switches
     */





















    /**
     * Set the path to the repository. This can also be controlled by
     * setting the GIT_DIR environment variable. It can be an absolute
     * path or relative path to current working directory.
     *
     * @param string $path Path to the git repository
     *
     * @return $this
     */
    public function gitDir($path)
    {
        if (!empty($path) && !is_dir($path)) {
            throw new DirectoryNotFoundException('No directory found at: '.$path);
        } elseif (empty($path)) {
            $path = '';
        }

        $this->gitDir = $path;

        return $this;
    }

    /**
     * Set the path to the working tree. It can be an absolute path or a
     * path relative to the current working directory. This can also be
     * controlled by setting the GIT_WORK_TREE environment variable and
     * the core.worktree configuration variable (see core.worktree in git-
     * config(1) for a more detailed discussion).
     *
     * @param string $path Path the git work tree
     *
     * @return $this
     */
    public function workTree($path)
    {
        if (!empty($path) && !is_dir($path)) {
            throw new DirectoryNotFoundException('No directory found at: '.$path);
        } elseif (empty($path)) {
            $path = '';
        }

        $this->workTree = $path;

        return $this;
    }

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
     * Treat the repository as a bare repository.
     *
     * @return $this
     */
    public function bare()
    {
        $this->bare = !$this->bare;

        return $this;
    }

    /**
     * Do not use replacement refs to replace Git objects.
     *
     * @return $this
     */
    public function noReplaceObjects()
    {
        $this->noReplaceObjects = !$this->noReplaceObjects;
        return $this;
    }

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
     * Add "glob" magic to all pathspec. This is equivalent to setting the
     * GIT_GLOB_PATHSPECS environment variable to 1. Disabling globbing on
     * individual pathspecs can be done using pathspec magic ":(literal)"
     *
     * @return $this
     */
    public function globPathspecs()
    {
        $this->globPathspecs = !$this->globPathspecs;
        return $this;
    }

    /**
     * Add "literal" magic to all pathspec. This is equivalent to setting
     * the GIT_NOGLOB_PATHSPECS environment variable to 1. Enabling
     * globbing on individual pathspecs can be done using pathspec magic
     * ":(glob)"
     *
     * @return $this
     */
    public function noGlobPathspecs()
    {
        $this->noGlobPathspecs = !$this->noGlobPathspecs;
        return $this;
    }

    /**
     * Add "icase" magic to all pathspec. This is equivalent to setting
     * the GIT_ICASE_PATHSPECS environment variable to 1.
     *
     * @return $this
     */
    public function iCasePathspecs()
    {
        $this->iCasePathspecs = !$this->iCasePathspecs;
        return $this;
    }

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

















        if (!empty($this->gitDir)) {
            $cmd .= ' --git-dir='.escapeshellarg($this->gitDir);
        }

        if (!empty($this->workTree)) {
            $cmd .= ' --work-tree='.escapeshellarg($this->workTree);
        }

        if (!empty($this->namespace)) {
            $cmd .= ' --namespace='.escapeshellarg($this->namespace);
        }

        if ($this->bare) {
            $cmd .= ' --bare';
        }

        if ($this->noReplaceObjects) {
            $cmd .= ' --no-replace-objects';
        }

        if ($this->literalPathspecs) {
            $cmd .= ' --literal-pathspecs';
        }

        if ($this->globPathspecs) {
            $cmd .= ' --glob-pathspecs';
        }

        if ($this->noGlobPathspecs) {
            $cmd .= ' --noglob-pathspecs';
        }

        if ($this->iCasePathspecs) {
            $cmd .= ' --icase-pathspecs';
        }

        return $cmd;
    }
}
