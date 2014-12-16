<?php
/**
 * Git Repository Service Provider
 *
 * This file contains the Git Repository Service Provider
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

/**
 * Git Repository Service Provider
 *
 * Git Repository Service Provider
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
class Repository
{
    /** @var \Reliv\Git\Command\GitCommand */
    protected $gitCommandWrapper;

    /**
     * Construct the Repository Service
     *
     * @param string            $repositoryPath       Path to repository
     * @param GitCommandWrapper $gitCommandWrapper    Git Command Wrapper
     * @param string            $pathToSeparateGitDir Set the path to the repository.  Only needed if your git
     *                                                repository directory is not located in the repository directory
     * @param string            $pathToWorkTree       Set the path to the working tree.  Only needed if the working
     *                                                tree sits outside the Repository Path.
     */
    public function __construct(
        $repositoryPath,
        GitCommandWrapper $gitCommandWrapper,
        $pathToSeparateGitDir = '',
        $pathToWorkTree = ''
    ) {
        if (is_dir($repositoryPath)) {
            $gitCommandWrapper->runInPath($repositoryPath);
        }

        if (!empty($pathToSeparateGitDir)) {
            $gitCommandWrapper->gitDir($pathToSeparateGitDir);
        }

        if (!empty($pathToWorkTree)) {
            $gitCommandWrapper->workTree($pathToWorkTree);
        }
    }
}
