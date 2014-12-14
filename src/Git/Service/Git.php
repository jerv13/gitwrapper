<?php
/**
 * Git Service Provider
 *
 * This file contains the Git Service Provider
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

namespace Git\Service;

use Git\Command\Git as GitCommandWrapper;
use Git\Exception\RuntimeException;

/**
 * Git Service Provider
 *
 * Git Service Provider
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
class Git
{
    /**
     * @var \Git\Command\Git
     */
    protected $gitCommandWrapper;

    /**
     * Constructor
     *
     * @param string $executable Path to git executable
     */
    public function __construct($executable)
    {
        $this->gitCommandWrapper = new GitCommandWrapper($executable);
    }

    /**
     * Create an empty Git repository or reinitialize an existing
     * one
     *
     * @param string $newRepoPath              Path to new or current repository
     * @param mixed  $shared                   Specify that the Git repository is to be shared amongst several
     *                                         users.  Only set this option if you know what you're doing.
     *                                         Possible values: false|true|umask|group|all|world|everybody|0xxx
     * @param string $templateDirectory        Specify the directory from which templates will be used.
     *                                         Only set this option if you know what you're doing.
     * @param string $separateGitDirectoryPath Instead of initializing the repository as a directory to either
     *                                         $GIT_DIR or ./.git/, create a text file there containing the path
     *                                         to the actual repository. This file acts as filesystem-agnostic Git
     *                                         symbolic link to the repository.
     *                                         If this is reinitialization, the repository will be moved to the
     *                                         specified path.
     *                                         Only set this option if you know what you're doing.
     *
     * @return Repository
     *
     * @throws RuntimeException
     */
    public function initRepository(
        $newRepoPath,
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

        $init = $this->getCommandWrapper()->runInPath($newRepoPath)->init();

        $result = $init->shared($shared)
            ->template($templateDirectory)
            ->separateGitDir($separateGitDirectoryPath)
            ->execute();

        if (!$result->isSuccess()) {
            throw new RuntimeException(
                'Unable to initialize repository at: '.$newRepoPath
                ."\nCommand Line Messages:\n".implode("\n", $result->getMessage())
            );
        }


        return new Repository(
            $newRepoPath,
            $this->getCommandWrapper(),
            $separateGitDirectoryPath
        );
    }


    /**
     * Get the command wrapper for Git
     *
     * @return \Git\Command\Git
     */
    public function getCommandWrapper()
    {
        return $this->gitCommandWrapper;
    }
}
