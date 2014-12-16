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
    protected $short            = false;
    protected $branch           = false;
    protected $porcelain        = false;
    protected $long             = false;
    protected $untrackedFiles   = '';
    protected $ignoreSubmodules = '';
    protected $ignored          = false;
    protected $z                = false;
    protected $column           = '';
    protected $noColumn         = '';
    protected $pathspec         = false;

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
     * Give the output in the short-format.
     *
     * @return $this
     */
    public function short()
    {
        $this->short = !$this->short;
        $this->porcelain = !$this->short;
        $this->long = !$this->short;
        return $this;
    }

    /**
     * Alias of short
     *
     * @return $this
     */
    public function s()
    {
        return $this->short();
    }

    /**
     * Show the branch and tracking info even in short-format.
     *
     * @return $this
     */
    public function branch()
    {
        $this->branch = !$this->branch;
        return $this;
    }

    /**
     * Alias of Branch
     *
     * @return Status
     */
    public function b()
    {
        return $this->branch();
    }

    /**
     * Give the output in an easy-to-parse format for scripts. This is
     * similar to the short output, but will remain stable across Git
     * versions and regardless of user configuration. See below for
     * details.
     *
     * @return $this
     */
    public function porcelain()
    {
        $this->porcelain = !$this->porcelain;
        $this->short = !$this->porcelain;
        $this->long = !$this->porcelain;
        return $this;
    }

    /**
     * Give the output in the long-format. This is the default.
     *
     * @return $this
     */
    public function long()
    {
        $this->long = !$this->long;
        $this->short = !$this->long;
        $this->porcelain = !$this->long;
        return $this;
    }

    /**
     * Show untracked files.
     *
     * The mode parameter is optional (defaults to all), and is used to
     * specify the handling of untracked files.
     * The possible options are:
     *     no - Show no untracked files.
     *     normal - Shows untracked files and directories.
     *     all - Also shows individual files in untracked directories.
     *
     * When -u option is not used, untracked files and directories are
     * shown (i.e. the same as specifying normal), to help you avoid
     * forgetting to add newly created files. Because it takes extra
     * work to find untracked files in the filesystem, this mode may
     * take some time in a large working tree. You can use no to have
     * git status return more quickly without showing untracked files.
     *
     * The default can be changed using the status.showUntrackedFiles
     * configuration variable documented in git-config(1).
     *
     * @param string $mode Mode.  Allowed: no, normal or all
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function untrackedFiles($mode = 'all')
    {
        $allowed = array(
            'no',
            'normal',
            'all'
        );

        $mode = strtolower($mode);

        if (!empty($mode) && !in_array($mode, $allowed)) {
            throw new InvalidArgumentException(
                'Invalid mode.  Allowed: no, normal or all'
            );
        } elseif (empty($mode)) {
            $mode = '';
        }

        $this->untrackedFiles = $mode;
        return $this;
    }

    /**
     * Alias of untrackedFiles
     *
     * @param string $mode Mode.  Allowed: no, normal or all
     *
     * @return Status
     */
    public function u($mode = 'all')
    {
        return $this->untrackedFiles($mode);
    }

    /**
     * Ignore changes to submodules when looking for changes. <when> can
     * be either "none", "untracked", "dirty" or "all", which is the
     * default. Using "none" will consider the submodule modified when it
     * either contains untracked or modified files or its HEAD differs
     * from the commit recorded in the superproject and can be used to
     * override any settings of the ignore option in git-config(1) or
     * gitmodules(5). When "untracked" is used submodules are not
     * considered dirty when they only contain untracked content (but they
     * are still scanned for modified content). Using "dirty" ignores all
     * changes to the work tree of submodules, only changes to the commits
     * stored in the superproject are shown (this was the behavior before
     * 1.7.0). Using "all" hides all changes to submodules (and suppresses
     * the output of submodule summaries when the config option
     * status.submodulesummary is set).
     *
     * @param string $when Possible Values: "none", "untracked", "dirty" or "all"
     *
     * @return $this
     */
    public function ignoreSubmodules($when = 'all')
    {
        $when = strtolower($when);

        $allowed = array(
            'none',
            'untracked',
            'dirty',
            'all'
        );

        if (!empty($when) && !in_array($when, $allowed)) {
            throw new InvalidArgumentException(
                'Invalid mode.  Allowed: no, normal or all'
            );
        } elseif (empty($when)) {
            $when = '';
        }

        $this->ignoreSubmodules = $when;
        return $this;
    }

    /**
     * Show ignored files as well.
     *
     * @return $this
     */
    public function ignored()
    {
        $this->ignored = !$this->ignored;
        return $this;
    }

    /**
     * Terminate entries with NUL, instead of LF. This implies the
     * --porcelain output format if no other format is given.
     *
     * @return $this
     */
    public function z()
    {
        $this->z = !$this->z;
        return $this;
    }

    /**
     * Display untracked files in columns. --column and
     * --no-column without options are equivalent to always and
     * never respectively.
     *
     * These options control when the feature should be enabled
     * (defaults to never):
     *     always  - always show in columns
     *     never   - never show in columns
     *     auto    - show in columns if the output is to the terminal
     *
     * These options control layout (defaults to column). Setting
     * any of these implies always if none of always, never, or auto
     * are specified.
     *     column  - fill columns before rows
     *     row     - fill rows before columns
     *     plain   - show in one column
     *
     * Finally, these options can be combined with a layout option
     * (defaults to nodense):
     *     dense   - make unequal size columns to utilize more space
     *     nodense - make equal size columns
     *
     * @param array $options List of options. Available options:
     *                       always, never, auto, column, row, plain
     *                       dense, nodense
     *
     * @return $this
     */
    public function column(Array $options)
    {
        $allowed = array(
            'always',
            'never',
            'auto',
            'column',
            'row',
            'plain',
            'dense',
            'nodense',
        );

        foreach ($options as $key => &$option) {
            $option = strtolower($option);

            if (empty($option) || !in_array($option, $allowed)) {
                throw new InvalidArgumentException(
                    'Invalid option passed for column.  Available'
                    .' options: always, never, auto, column, row, plain'
                    .' dense, nodense'
                );
            }
        }

        $this->column = implode(',', $options);
        $this->noColumn = false;
        return $this;
    }

    /**
     * Do not display untracked files in columns.  This command
     * is the equivalent of calling --column=never
     *
     * @return $this
     */
    public function noColumn()
    {
        $this->noColumn = !$this->noColumn;
        $this->column = array();
        return $this;
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' status';

        if ($this->short) {
            $cmd .= ' --short';
        }

        if ($this->branch) {
            $cmd .= ' --branch';
        }

        if ($this->porcelain) {
            $cmd .= ' --porcelain';
        }

        if ($this->long) {
            $cmd .= ' --long';
        }

        if ($this->untrackedFiles) {
            $cmd .= ' --untracked-files='.escapeshellarg($this->untrackedFiles);
        }

        if ($this->ignoreSubmodules) {
            $cmd .= ' --ignore-submodules='.escapeshellarg($this->ignoreSubmodules);
        }

        if ($this->ignored) {
            $cmd .= ' --ignored';
        }

        if ($this->z) {
            $cmd .= ' -z';
        }

        if ($this->column) {
            $cmd .= ' --column='.escapeshellarg($this->column);
        }

        if ($this->noColumn) {
            $cmd .= ' --no-column';
        }

        if ($this->pathspec) {
            $cmd .= ' -- '.escapeshellarg($this->pathspec);
        }

        return $cmd;
    }
}
