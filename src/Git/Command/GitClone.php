<?php

/**
 * Clone Command
 *
 * This file contains the Clone Command
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

/**
 * Clone Command
 *
 * Clones a repository into a newly created directory, creates
 * remote-tracking branches for each branch in the cloned repository
 * (visible using git branch -r), and creates and checks out an initial
 * branch that is forked from the cloned repository's currently active
 * branch.
 *
 * After the clone, a plain git fetch without arguments will update all
 * the remote-tracking branches, and a git pull without arguments will in
 * addition merge the remote master branch into the current master branch,
 * if any (this is untrue when "--single-branch" is given; see below).
 *
 * This default configuration is achieved by creating references to the
 * remote branch heads under refs/remotes/origin and by initializing
 * remote.origin.url and remote.origin.fetch configuration variables.
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
 */
class GitClone extends CommandAbstract
{
    protected $local          = false;
    protected $noHardLinks    = false;
    protected $shared         = false;
    protected $reference      = '';
    protected $quiet          = false;
    protected $verbose        = false;
    protected $progress       = false;
    protected $noCheckout     = false;
    protected $bare           = false;
    protected $mirror         = false;
    protected $origin         = 'origin';
    protected $branch         = '';
    protected $uploadPack     = '';
    protected $template       = '';
    protected $config         = array();
    protected $depth          = null;
    protected $singleBranch   = false;
    protected $noSingleBranch = false;
    protected $recursive      = false;
    protected $separateGitDir = '';
    protected $remote         = '';
    protected $toDir          = '';

    /**
     * Constructor.
     *
     * Command must be called as follows:
     * <code>
     *      $command = new GitClone(
     *          'pathToGit',
     *          array(
     *              'path to repository to clone',
     *              'path in current folder to clone to (optional)'
     *          );
     * </code>
     *
     * @param CommandInterface $parent    Command to wrap
     * @param array            $arguments Defined array.  See method Definition.
     *
     * @throws InvalidArgumentException
     */
    public function __construct(CommandInterface $parent, Array $arguments)
    {
        parent::__construct($parent);

        if (empty($arguments[0])) {
            throw new InvalidArgumentException(
                'No source repository found in calling arguments.'
            );
        }

        $this->remote = $arguments[0];

        if (!empty($arguments[1])) {
            $this->toDir = $arguments[1];
        }
    }

    /**
     * When the repository to clone from is on a local machine, this flag
     * bypasses the normal "Git aware" transport mechanism and clones the
     * repository by making a copy of HEAD and everything under objects
     * and refs directories. The files under .git/objects/ directory are
     * hard linked to save space when possible.
     *
     * If the repository is specified as a local path
     * (e.g.,/path/to/repo), this is the default, and --local is essentially a
     * no-op. If the repository is specified as a URL, then this flag is
     * ignored (and we never use the local optimizations). Specifying
     * --no-local will override the default when /path/to/repo is given,
     * using the regular Git transport instead.
     *
     * @return $this
     */
    public function local()
    {
        $this->local = !$this->local;
        return $this;
    }

    /**
     * Alias of Local
     *
     * @return $this
     */
    public function l()
    {
        return $this->local();
    }

    /**
     * Force the cloning process from a repository on a local filesystem
     * to copy the files under the .git/objects directory instead of using
     * hardlinks. This may be desirable if you are trying to make a
     * back-up of your repository.
     *
     * @return $this
     */
    public function noHardLinks()
    {
        $this->noHardLinks = !$this->noHardLinks;
        return $this;
    }

    /**
     * When the repository to clone is on the local machine, instead of
     * using hard links, automatically setup .git/objects/info/alternates
     * to share the objects with the source repository. The resulting
     * repository starts out without any object of its own.
     *
     * NOTE: this is a possibly dangerous operation; do not use it unless
     * you understand what it does. If you clone your repository using
     * this option and then delete branches (or use any other Git command
     * that makes any existing commit unreferenced) in the source
     * repository, some objects may become unreferenced (or dangling).
     * These objects may be removed by normal Git operations (such as git
     * commit) which automatically call git gc --auto. (See git-gc(1).) If
     * these objects are removed and were referenced by the cloned
     * repository, then the cloned repository will become corrupt.
     *
     * Note that running git repack without the -l option in a repository
     * cloned with -s will copy objects from the source repository into a
     * pack in the cloned repository, removing the disk space savings of
     * clone -s. It is safe, however, to run git gc, which uses the -l
     * option by default.
     *
     * If you want to break the dependency of a repository cloned with -s
     * on its source repository, you can simply run git repack -a to copy
     * all objects from the source repository into a pack in the cloned
     * repository.
     *
     * @return $this
     */
    public function shared()
    {
        $this->shared = !$this->shared;
        return $this;
    }

    /**
     * Alias of Shared
     *
     * @return $this
     */
    public function s()
    {
        return $this->shared();
    }

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
     * Operate quietly. Progress is not reported to the standard error
     * stream. This flag is also passed to the `rsync' command when given.
     *
     * @return $this
     */
    public function quiet()
    {
        $this->quiet = !$this->quiet;
        return $this;
    }

    /**
     * Alias of Quiet
     *
     * @return $this
     */
    public function q()
    {
        return $this->quiet();
    }

    /**
     * Run verbosely. Does not affect the reporting of progress status to
     * the standard error stream.
     *
     * @return $this
     */
    public function verbose()
    {
        $this->verbose = !$this->verbose;
        return $this;
    }

    /**
     * Progress status is reported on the standard error stream by default
     * when it is attached to a terminal, unless -q is specified. This
     * flag forces progress status even if the standard error stream is
     * not directed to a terminal.
     *
     * @return $this
     */
    public function progress()
    {
        $this->progress = !$this->progress;
        return $this;
    }

    /**
     * No checkout of HEAD is performed after the clone is complete.
     *
     * @return $this
     */
    public function noCheckout()
    {
        $this->noCheckout = !$this->noCheckout;
        return $this;
    }

    /**
     * Alias of noCheckout
     *
     * @return $this
     */
    public function n()
    {
        return $this->noCheckout();
    }

    /**
     * Create a bare repository.
     *
     * @return $this
     */
    public function bare()
    {
        $this->bare = !$this->bare;
        return $this;
    }

    /**
     * Set up a mirror of the source repository. This implies --bare.
     * Compared to --bare, --mirror not only maps local branches of the
     * source to local branches of the target, it maps all refs (including
     * remote-tracking branches, notes etc.) and sets up a refspec
     * configuration such that all these refs are overwritten by a git
     * remote update in the target repository.
     *
     * @return $this
     */
    public function mirror()
    {
        $this->mirror = !$this->mirror;
        return $this;
    }

    /**
     * Instead of using the remote name origin to keep track of the
     * upstream repository, use <name>.
     *
     * @param string $name Alternate name for origin
     *
     * @return $this
     */
    public function origin($name)
    {
        if (empty($name) || strtolower($name) == 'origin') {
            $name = 'origin';
        }

        $this->origin = $name;
        return $this;
    }

    /**
     * Instead of pointing the newly created HEAD to the branch pointed to
     * by the cloned repository's HEAD, point to <name> branch instead. In
     * a non-bare repository, this is the branch that will be checked out.
     * --branch can also take tags and detaches the HEAD at that commit in
     * the resulting repository.
     *
     * @param string $name Name of branch to checkout after clone
     *
     * @return $this
     */
    public function branch($name)
    {
        if (empty($name)) {
            $name = '';
        }

        $this->branch = $name;
        return $this;
    }

    /**
     * When given, and the repository to clone from is accessed via ssh,
     * this specifies a non-default path for the command run on the other
     * end.
     *
     * @param string $path Path to non-default git-upload-pack command
     *
     * @return $this
     */
    public function uploadPack($path)
    {
        if (empty($path)) {
            $path = '';
        }

        $this->uploadPack = $path;
        return $this;
    }

    /**
     * Alias of uploadPack
     *
     * @param string $path Path to non-default git-upload-pack command
     *
     * @return $this
     */
    public function u($path)
    {
        return $this->uploadPack($path);
    }

    /**
     * Specify the directory from which templates will be used.
     *
     * @param string $path Directory of templates
     *
     * @return $this
     * @throws DirectoryNotFoundException
     */
    public function template($path)
    {
        if (!empty($path) && !is_dir($path)) {
            throw new DirectoryNotFoundException('No directory found at: '.$path);
        } elseif (empty($path)) {
            $path = '';
        }

        $this->template = $path;

        return $this;
    }

    /**
     * Set a configuration variable in the newly-created repository; this
     * takes effect immediately after the repository is initialized, but
     * before the remote history is fetched or any files checked out. The
     * key is in the same format as expected by git-config(1) (e.g.,
     * core.eol=true). If multiple values are given for the same key, each
     * value will be written to the config file. This makes it safe, for
     * example, to add additional fetch refspecs to the origin remote.
     *
     * Values should be passed as key value pairs. example:
     * <code>
     * array(
     *    'myKey' => 'myValue',
     *    'myKey2' => 'myValue2'
     * )
     * </code>
     *
     * @param array $options Array of key value pairs.
     *
     * @return $this
     *
     * @todo Create a validator for config options.  Currently we just pass the values through to git and let it fail.
     */
    public function config(Array $options)
    {
        $this->config = $options;
        return $this;
    }

    /**
     * Create a shallow clone with a history truncated to the specified
     * number of revisions.
     *
     * @param integer $depth Number of revisions to limit clone by.
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function depth($depth)
    {
        if (!empty($depth) && !is_numeric($depth)) {
            throw new InvalidArgumentException(
                'Only numeric values can be used when setting the depth of a clone.'
            );
        } elseif (empty($depth)) {
            $depth = null;
        }

        $this->depth = $depth;
        return $this;
    }

    /**
     * Clone only the history leading to the tip of a single branch,
     * either specified by the --branch option or the primary branch
     * remote's HEAD points at. When creating a shallow clone with the
     * --depth option, this is the default, unless --no-single-branch is
     * given to fetch the histories near the tips of all branches. Further
     * fetches into the resulting repository will only update the
     * remote-tracking branch for the branch this option was used for the
     * initial cloning. If the HEAD at the remote did not point at any
     * branch when --single-branch clone was made, no remote-tracking
     * branch is created.
     *
     * @return $this
     */
    public function singleBranch()
    {
        $this->singleBranch = !$this->singleBranch;
        $this->noSingleBranch = !$this->singleBranch;

        return $this;
    }

    /**
     * Clone only the history leading to the tip of a single branch,
     * either specified by the --branch option or the primary branch
     * remote's HEAD points at. When creating a shallow clone with the
     * --depth option, this is the default, unless --no-single-branch is
     * given to fetch the histories near the tips of all branches. Further
     * fetches into the resulting repository will only update the
     * remote-tracking branch for the branch this option was used for the
     * initial cloning. If the HEAD at the remote did not point at any
     * branch when --single-branch clone was made, no remote-tracking
     * branch is created.
     *
     * @return $this
     */
    public function noSingleBranch()
    {
        $this->noSingleBranch = !$this->noSingleBranch;
        $this->singleBranch = !$this->noSingleBranch;

        return $this;
    }

    /**
     * After the clone is created, initialize all submodules within, using
     * their default settings. This is equivalent to running git submodule
     * update --init --recursive immediately after the clone is finished.
     *
     * This option is ignored if the cloned repository does not have a
     * worktree/checkout (i.e. if any of --no-checkout/-n, --bare, or
     * --mirror is given)
     *
     * @return $this
     */
    public function recursive()
    {
        $this->recursive = !$this->recursive;
        return $this;
    }

    /**
     * Instead of initializing the repository as a directory to either
     * $GIT_DIR or ./.git/, create a text file there containing the path
     * to the actual repository. This file acts as filesystem-agnostic Git
     * symbolic link to the repository.
     *
     * @param string $path Path to Git Directory
     *
     * @return $this
     * @throws DirectoryNotFoundException
     */
    public function separateGitDir($path)
    {
        if (!empty($path) && !is_dir($path)) {
            throw new DirectoryNotFoundException('No directory found at: '.$path);
        } elseif (empty($path)) {
            $path = '';
        }

        $this->separateGitDir = $path;

        return $this;
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' clone';

        if ($this->local) {
            $cmd .= ' --local';
        }

        if ($this->noHardLinks) {
            $cmd .= ' --no-hardlinks';
        }

        if ($this->shared) {
            $cmd .= ' --shared';
        }

        if (!empty($this->reference)) {
            $cmd .= ' --reference '.escapeshellarg($this->reference);
        }

        if ($this->quiet) {
            $cmd .= ' --quiet';
        }

        if ($this->verbose) {
            $cmd .= ' --verbose';
        }

        if ($this->progress) {
            $cmd .= ' --progress';
        }

        if ($this->noCheckout) {
            $cmd .= ' --no-checkout';
        }

        if ($this->bare) {
            $cmd .= ' --bare';
        }

        if ($this->mirror) {
            $cmd .= ' --mirror';
        }

        if (!empty($this->origin) && $this->origin != 'origin') {
            $cmd .= ' --origin '.escapeshellarg($this->origin);
        }

        if (!empty($this->branch)) {
            $cmd .= ' --branch '.escapeshellarg($this->branch);
        }

        if (!empty($this->uploadPack)) {
            $cmd .= ' --upload-pack '.escapeshellarg($this->uploadPack);
        }

        if (!empty($this->template)) {
            $cmd .= ' --template='.escapeshellarg($this->template);
        }

        if (!empty($this->config) && is_array($this->config)) {
            foreach ($this->config as $configKey => $configValue) {
                $cmd .= ' --config '
                    .escapeshellarg($configKey).'='
                    .escapeshellarg($configValue);
            }
        }

        if ($this->depth) {
            $cmd .= ' --depth '.escapeshellarg($this->depth);
        }

        if ($this->singleBranch) {
            $cmd .= ' --single-branch';
        }

        if ($this->noSingleBranch) {
            $cmd .= ' --no-single-branch';
        }

        if ($this->recursive) {
            $cmd .= ' --recursive';
        }

        if (!empty($this->separateGitDir)) {
            $cmd .= ' --separate-git-dir='.escapeshellarg($this->separateGitDir);
        }

        $cmd .= ' '.escapeshellarg($this->remote);

        if (!empty($this->toDir)) {
            $cmd .= ' '.escapeshellarg($this->toDir);
        }

        return $cmd;
    }
}
