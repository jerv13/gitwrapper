<?php
/**
 * Git Service Provider
 *
 * This file contains the Git Service Provider
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

namespace Reliv\Git\Service;

use Reliv\Git\Command\GitCommand as GitCommandWrapper;
use Reliv\Git\Exception\RuntimeException;

/**
 * Git Service Provider
 *
 * Git Service Provider
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
class Git
{
    protected $executable;

    /**
     * Constructor
     *
     * @param string $executable Path to git executable
     */
    public function __construct($executable)
    {
        $this->executable = $executable;
    }

    /**
     * Create an empty Git repository or reinitialize an existing
     * one
     *
     * @param string  $newRepoPath              Path to new or current repository
     * @param boolean $bare                     Create a bare repository.
     * @param mixed   $shared                   Specify that the Git repository is to be shared amongst several
     *                                          users.  Only set this option if you know what you're doing.
     *                                          Possible values: false|true|umask|group|all|world|everybody|0xxx
     * @param string  $templateDirectory        Specify the directory from which templates will be used.
     *                                          Only set this option if you know what you're doing.
     * @param string  $separateGitDirectoryPath Instead of initializing the repository as a directory to either
     *                                          $GIT_DIR or ./.git/, create a text file there containing the path
     *                                          to the actual repository. This file acts as filesystem-agnostic Git
     *                                          symbolic link to the repository.
     *                                          If this is reinitialization, the repository will be moved to the
     *                                          specified path.
     *                                          Only set this option if you know what you're doing.
     *
     * @return Repository
     *
     * @throws RuntimeException
     */
    public function initRepository(
        $newRepoPath,
        $bare = false,
        $shared = 'umask',
        $templateDirectory = '',
        $separateGitDirectoryPath = ''
    ) {
        if (!is_dir($newRepoPath)) {
            $mkdir = @mkdir($newRepoPath, 0777, true);

            if (!$mkdir) {
                throw new RuntimeException('Unable to create directory at: '.$newRepoPath);
            }
        }

        $gitCommandWrapper = $this->getCommandWrapper($newRepoPath, $separateGitDirectoryPath);

        $init = $gitCommandWrapper->init($newRepoPath)
            ->shared($shared)
            ->template($templateDirectory);

        if ($bare) {
            $init->bare();
        }

        $result = $init->execute();

        if (!$result->isSuccess()) {
            throw new RuntimeException(
                'Unable to initialize repository at: '.$newRepoPath
                ."\nCommand Line Messages:\n".implode("\n", $result->getMessage())
            );
        }

        return new Repository(
            $newRepoPath,
            $gitCommandWrapper
        );
    }

    /**
     * Clone a Git repository
     *
     * @param string  $from                     Git Repository to clone
     * @param string  $newRepoPath              Path to new or current repository
     * @param string  $branch                   Branch to clone. Pass null to clone all branches (default)
     * @param integer $depth                    Depth to clone.  Pass 0 to make a complete clone.
     * @param boolean $bare                     Create a bare repository.
     * @param string  $templateDirectory        Specify the directory from which templates will be used.
     *                                          Only set this option if you know what you're doing.
     * @param string  $separateGitDirectoryPath Instead of initializing the repository as a directory to either
     *                                          $GIT_DIR or ./.git/, create a text file there containing the path
     *                                          to the actual repository. This file acts as filesystem-agnostic Git
     *                                          symbolic link to the repository.
     *                                          If this is reinitialization, the repository will be moved to the
     *                                          specified path.
     *                                          Only set this option if you know what you're doing.
     *
     * @return Repository
     *
     * @throws RuntimeException
     */
    public function cloneRepository(
        $from,
        $newRepoPath,
        $branch = null,
        $depth = 0,
        $bare = false,
        $templateDirectory = '',
        $separateGitDirectoryPath = ''
    ) {
        if (!is_dir($newRepoPath)) {
            $mkdir = @mkdir($newRepoPath, 0777, true);

            if (!$mkdir) {
                throw new RuntimeException('Unable to create directory at: '.$newRepoPath);
            }
        }

        $gitCommandWrapper = $this->getCommandWrapper($newRepoPath, $separateGitDirectoryPath);

        $clone = $gitCommandWrapper->clone($from);

        if ($bare) {
            $clone->bare();
        }

        $result = $clone
            ->branch($branch)
            ->depth($depth)
            ->template($templateDirectory)
            ->execute();

        if (!$result->isSuccess()) {
            throw new RuntimeException(
                'Unable to initialize repository at: '.$newRepoPath
                ."\nCommand Line Messages:\n".implode("\n", $result->getMessage())
            );
        }

        return new Repository(
            $newRepoPath,
            $gitCommandWrapper
        );
    }

    /**
     * Get a reposigory object
     *
     * @param string $repositoryPath       Path to repository
     * @param string $separateGitDirectory Path to Git directory
     *
     * @return Repository
     */

    public function getRepository(
        $repositoryPath,
        $separateGitDirectory = ''
    ) {
        $gitCommandWrapper = $this->getCommandWrapper();

        if (!empty($separateGitDirectory)) {
            $gitCommandWrapper->gitDir($separateGitDirectory);
        }

        return new Repository($repositoryPath, $gitCommandWrapper);
    }


    /**
     * Get the command wrapper for Git
     *
     * @param string      $repoPath Path to new or existing repository
     * @param null|string $gitDir   Path to working git directory.  Generally not needed.
     *
     * @return \Reliv\Git\Command\GitCommand
     */
    public function getCommandWrapper(
        $repoPath = null,
        $gitDir = null
    ) {
        $commandWrapper = new GitCommandWrapper($this->executable);

        if ($repoPath && $gitDir) {
            $commandWrapper->gitDir($gitDir);
            $commandWrapper->runInPath($repoPath);
        }

        return $commandWrapper;
    }
}
