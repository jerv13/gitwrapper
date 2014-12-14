<?php

/**
 * Git Command
 *
 * This file contains the Git Command
 *
 * PHP version 5.3
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

namespace Git\Command;

use Git\Exception\DirectoryNotFoundException;
use Git\Exception\InvalidArgumentException;
use Git\Exception\MethodNotFoundException;

/**
 * Git Command
 *
 * Git Command.  Parent Command
 *
 * PHP version 5.3
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
 * @method Add      add()                       Add file contents to the index
 * @method Bisect   bisect()                    Find by binary search the change that introduced a bug
 * @method Branch   branch()                    List, create, or delete branches
 * @method Checkout checkout()                  Checkout a branch or paths to the working tree
 * @method GitClone clone($from, $toDir = null) Clone a repository into a new directory
 * @method Commit   commit()                    Record changes to the repository
 * @method Diff     diff()                      Show changes between commits, commit and working tree, etc
 * @method Fetch    fetch()                     Download objects and refs from another repository
 * @method Grep     grep()                      Print lines matching a pattern
 * @method Log      log()                       Show commit logs
 * @method Merge    merge()                     Join two or more development histories together
 * @method Mv       mv()                        Move or rename a file, a directory, or a symlink
 * @method Pull     pull()                      Fetch from and integrate with another repository or a local branch
 * @method Push     push()                      Update remote refs along with associated objects
 * @method Rebase   rebase()                    Forward-port local commits to the updated upstream head
 * @method Reset    reset()                     Reset current HEAD to the specified state
 * @method RevParse revParse()                  Pick out and massage parameters
 * @method Rm       rm()                        Remove files from the working tree and from the index
 * @method Show     show()                      Show various types of objects
 * @method Status   status()                    Show the working tree status
 * @method Tag      tag()                       Create, list, delete or verify a tag object signed with GPG
 */
class Git extends CommandAbstract
{
    protected $executable;

    protected $version = false;
    protected $help = false;
    protected $runInPath = '';
    protected $c = array();
    protected $executablePath = false;
    protected $htmlPath = false;
    protected $manPath = false;
    protected $infoPath = false;
    protected $paginate = false;
    protected $noPager = false;
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
        $class = __NAMESPACE__.'\\'.$name;

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
     * @return GitClone
     */
    public function cloneFrom($from, $toDir = null)
    {
        return new GitClone($this, $from, $toDir);
    }

    /**
     * Create an empty Git repository or reinitialize an existing one
     *
     * @param string $path Directory path for new or existing repository
     *
     * @return Init
     */
    public function init($path = null)
    {
        if ($path) {
            $this->workTree($path);
        }

        return new Init($this);
    }

    /*
     * Command Arguments and Switches
     */

    /**
     * Prints the Git suite version that the git program came from.
     *
     * @return $this
     */
    public function version()
    {
        $this->version = !$this->version;
        return $this;
    }

    /**
     * Prints the synopsis and a list of the most commonly used commands.
     * If the option --all or -a is given then all available commands are
     * printed. If a Git command is named this option will bring up the
     * manual page for that command.
     *
     * Other options are available to control how the manual page is
     * displayed. See git-help(1) for more information, because git --help
     * ...  is converted internally into git help ....
     *
     * @return $this
     */
    public function help()
    {
        $this->help = !$this->help;
        return $this;
    }

    /**
     * -C command, renamed to runInPath due to PHP case insensitive nature.
     *
     * Run as if git was started in <path> instead of the current working
     * directory. When multiple -C options are given, each subsequent
     * non-absolute -C <path> is interpreted relative to the preceding -C
     * <path>.
     *
     * This option affects options that expect path name like --git-dir
     * and --work-tree in that their interpretations of the path names
     * would be made relative to the working directory caused by the -C
     * option. For example the following invocations are equivalent:
     * <code>
     *     git --git-dir=a.git --work-tree=b -C c status
     *     git --git-dir=c/a.git --work-tree=c/b status
     * </code>
     *
     * @param string $path Path to run git from.
     *
     * @return $this
     */
    public function runInPath($path)
    {
        if (!empty($path) && !is_dir($path)) {
            throw new DirectoryNotFoundException('No directory found at: '.$path);
        } elseif (empty($path)) {
            $path = '';
        }

        $this->runInPath = $path;

        return $this;
    }

    /**
     * Pass a configuration parameter to the command. The value given will
     * override values from configuration files. The <name> is expected in
     * the same format as listed by git config (subkeys separated by
     * dots).
     *
     * Array passed to this method must be in the following format:
     * <code>
     *     array( $configName => $configValue, $configNameTwo => $configValueTwo, ect...)
     * </code>
     *
     * @param array $configuration Array of config values to pass.  array($configname => $value)
     *
     * @return $this
     */
    public function c(Array $configuration)
    {
        $this->c = $configuration;
        return $this;
    }

    /**
     * Path to wherever your core Git programs are installed. This can
     * also be controlled by setting the GIT_EXEC_PATH environment
     * variable. If no path is given, git will print the current setting
     * and then exit.
     *
     * @param string|boolean $path Path to git executable files.  If empty string is given
     *                             then git will print the current setting and then exit upon
     *                             execution.
     *
     * @return $this
     */
    public function executablePath($path = null)
    {
        if (!empty($path) && !is_dir($path)) {
            throw new DirectoryNotFoundException('No directory found at: '.$path);
        } elseif ($path === false) {
            $path = false;
        } elseif (empty($path)) {
            $path = '';
        }

        $this->executablePath = $path;

        return $this;
    }

    /**
     * Print the path, without trailing slash, where Git's HTML
     * documentation is installed and exit.
     *
     * @return $this
     */
    public function htmlPath()
    {
        $this->htmlPath = !$this->htmlPath;
        return $this;
    }

    /**
     * Print the manPath (see man(1)) for the man pages for this version
     * of Git and exit.
     *
     * @return $this
     */
    public function manPath()
    {
        $this->manPath = !$this->manPath;
        return $this;
    }

    /**
     * Print the path where the Info files documenting this version of Git
     * are installed and exit.
     *
     * @return $this
     */
    public function infoPath()
    {
        $this->infoPath = !$this->infoPath;
        return $this;
    }

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
        return $this;
    }


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

        if ($this->version) {
            $cmd .= ' --version';
        }

        if ($this->help) {
            $cmd .= ' --help';
        }

        if (!empty($this->runInPath)) {
            $cmd .= ' -C '.escapeshellarg($this->runInPath);
        }

        if (!empty($this->c) && is_array($this->c)) {
            foreach ($this->c as $configKey => $configValue) {

                if (empty($configValue)) {
                    $configValue = 'false';
                }

                $cmd .= ' -c '.escapeshellarg($configKey).'='.escapeshellarg($configValue);
            }
        }

        if (!empty($this->executablePath)) {
            $cmd .= ' --exec-path='.escapeshellarg($this->executablePath);
        } elseif ($this->executablePath !== false) {
            $cmd .= ' --exec-path';
        }

        if ($this->htmlPath) {
            $cmd .= ' --html-path';
        }

        if ($this->manPath) {
            $cmd .= ' --man-path';
        }

        if ($this->infoPath) {
            $cmd .= ' --info-path';
        }

        if ($this->paginate) {
            $cmd .= ' --paginate';
        }

        if ($this->noPager) {
            $cmd .= ' --no-pager';
        }

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
