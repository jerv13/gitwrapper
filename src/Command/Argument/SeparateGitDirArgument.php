<?php
/**
 * SeparateGitDir Argument
 *
 * This file contains the SeparateGitDir Argument for Commands
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

use Reliv\Git\Exception\DirectoryNotFoundException;

/**
 * SeparateGitDir Argument
 *
 * SeparateGitDir Argument.
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
trait SeparateGitDirArgument
{
    protected $separateGitDir = '';

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
     * Get the command line parameter
     *
     * @return string
     */
    public function getSeparateGitDir()
    {
        $cmd = '';

        if (!empty($this->separateGitDir)) {
            $cmd .= ' --separate-git-dir='.escapeshellarg($this->separateGitDir);
        }

        return $cmd;
    }
}
