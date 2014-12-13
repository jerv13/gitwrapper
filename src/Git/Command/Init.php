<?php

/**
 * Init Command
 *
 * This file contains the Init Command
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
 * Init Command
 *
 * Init Command.  Create an empty Git repository or reinitialize an existing one
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
class Init extends CommandAbstract
{
    protected $quiet          = false;
    protected $bare           = false;
    protected $template       = '';
    protected $separateGitDir = '';
    protected $shared         = 'umask';

    /**
     * Only print error and warning messages; all other output will be suppressed.
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
     * Specify the directory from which templates will be used.
     *
     * @param string $path Directory of templates
     *
     * @return $this
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
     * Instead of initializing the repository as a directory to either
     * $GIT_DIR or ./.git/, create a text file there containing the path
     * to the actual repository. This file acts as filesystem-agnostic Git
     * symbolic link to the repository.
     *
     * @param string $path Path to Git Directory
     *
     * @return $this
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
     * Specify that the Git repository is to be shared amongst several users.
     *
     * @param string $value false|true|umask|group|all|world|everybody|0xxx
     *
     * @return $this
     */
    public function shared($value = 'group')
    {
        if (empty($value) && $value !== false) {
            $value = 'group';
        } elseif (empty($value) && $value === false) {
            $value = 'umask';
        } elseif ($value === true || $value == 'true') {
            $value = 'group';
        } elseif ($value == 'world' || $value == 'everybody') {
            $value = 'all';
        }

        $allowed = array(
            'true',
            'false',
            'umask',
            'group',
            'all',
            'world',
            'everybody'
        );

        if (!is_numeric($value) && !in_array($value, $allowed)) {
            throw new InvalidArgumentException(
                'Invalid shared property.  Allowed: '.implode(', ', $allowed).', 0xxx'
            );
        }

        $this->shared = $value;
        return $this;
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' init';

        if ($this->quiet) {
            $cmd .= ' --quiet';
        }

        if ($this->bare) {
            $cmd .= ' --bare';
        }

        if (!empty($this->template)) {
            $cmd .= ' --template='.escapeshellarg($this->template);
        }

        if (!empty($this->separateGitDir)) {
            $cmd .= ' --separate-git-dir='.escapeshellarg($this->separateGitDir);
        }

        if ($this->shared !== 'umask') {
            $cmd .= ' --shared='.escapeshellarg($this->shared);
        }

        return $cmd;
    }
}
