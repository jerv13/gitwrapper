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
use Reliv\Git\Exception\DetachedHeadException;
use Reliv\Git\Exception\DirectoryNotFoundException;
use Reliv\Git\Exception\RuntimeException;

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
    protected $repositoryPath = '';

    protected $cachedRefs = array();

    /**
     * Construct the Repository Service
     *
     * @param string            $repositoryPath    Path to repository
     * @param GitCommandWrapper $gitCommandWrapper Git Command Wrapper
     */
    public function __construct(
        $repositoryPath,
        GitCommandWrapper $gitCommandWrapper
    ) {
        $this->repositoryPath = $repositoryPath;
        $this->gitCommandWrapper = $gitCommandWrapper;

        if (!$this->isRemote()) {
            $this->gitCommandWrapper->runInPath($repositoryPath);
        }
    }

    /**
     * Checkout a branch, commit, or tag
     *
     * @param string      $branchOrTag Branch or tag name to checkout.  If using a tracking refspec then this will
     *                                 become the new branch name.
     * @param null|string $trackingRef Refspec to track...  ie origin/master
     *
     * @return $this
     */
    public function checkout($branchOrTag, $trackingRef = null)
    {
        if ($trackingRef) {
            $result = $this->gitCommandWrapper->checkout($trackingRef)->b($branchOrTag)->track()->execute();
        } else {
            $result = $this->gitCommandWrapper->checkout($trackingRef)->execute();
        }

        if (!$result->isSuccess()) {
            throw new RuntimeException(
                "Unable to checkout ".$branchOrTag
            );
        }

        return $this;
    }

    /**
     * Fetch remote status and refspecs
     *
     * @param null|Repository|string $remote  Optional.  Repository object or Url to remote repository to fetch from.
     *                                        If not supplied it will fetch from all remotes.
     * @param null|string            $refspec Refspec to fetch.  IE. origin/master
     * @param null|integer           $depth   Depth to fetch.  Only use this if you know what you're doing.
     *
     * @return $this
     */
    public function fetch($remote = null, $refspec = null, $depth = null)
    {
        $gitCommand = $this->gitCommandWrapper;

        if ($remote instanceof Repository) {
            $remotePath = $remote->getRepositoryPath();
        } else {
            $remotePath = $remote;
        }

        $fetch = $gitCommand->fetch($remotePath, $refspec);

        if ($depth && is_numeric($depth)) {
            $fetch->depth($depth);
        }

        $result = $fetch->execute();

        if (!$result->isSuccess()) {
            throw new RuntimeException(
                "Unable to fetch repository: ".$remote
            );
        }

        return $this;
    }

    /**
     * Add a remote repository to track
     *
     * @param string            $name       Name to use for remote target.
     * @param Repository|string $repository Repository object or URL to the repository to add.
     *
     * @return $this
     */
    public function addRemote($name, $repository)
    {
        if ($repository instanceof Repository) {
            $repositoryPath = $repository->getRepositoryPath();
        } else {
            $repositoryPath = $repository;
        }

        $gitCommand = $this->gitCommandWrapper;

        $result = $gitCommand->remote()->add($name, $repositoryPath)->execute();

        if (!$result->isSuccess()) {
            throw new RuntimeException(
                "Unable to add repository: ".$repositoryPath." as a remote."
            );
        }

        return $this;
    }

    /**
     * Clone a repository.
     *
     * note: Due to the way clone works and that the repository to be cloned my not be a bare repo,
     * we will emulate clone's behavior but will not use clone directly.
     *
     * @param string       $path  Path to local directory for new repository
     * @param null|integer $depth Depth to clone.
     *
     * @return Repository
     */
    public function cloneTo($path, $depth = null)
    {
        if (!is_dir($path)) {
            throw new DirectoryNotFoundException(
                $path. " is not a valid directory"
            );
        }

        if (!is_writable($path)) {
            throw new RuntimeException(
                "Unable to write to: ".$path
            );
        }

        if ($this->inDetachedHead()) {
            throw new DetachedHeadException(
                "Unable to clone repository while in a detached head state."
            );
        }

        $gitCommand = $this->gitCommandWrapper;
        $currentBranch = $this->getCurrentBranch();

        $result = $gitCommand->init()->execute();

        if (!$result->isSuccess()) {
            throw new RuntimeException(
                "Unable to initialize repository at ".$path
            );
        }

        $newRepository = new self($path, $this->gitCommandWrapper);
        $newRepository->addRemote('origin', $this);

        if ($depth) {
            $newRepository->fetch($this, 'origin/'.$currentBranch, $depth);
        } else {
            $newRepository->fetch();
        }

        $newRepository->checkout($currentBranch, 'origin/'.$currentBranch);

        return $newRepository;
    }

    /**
     * Get the current checked out branch
     *
     * @return mixed
     */
    public function getCurrentBranch()
    {
        $refs = $this->getRefs();

        foreach ($refs as $ref => $commit) {
            if ($commit == $refs['HEAD'] && strpos($ref, 'refs/heads/') !== false) {
                return str_replace('refs/heads/', '', $ref);
            }
        }

        throw new DetachedHeadException(
            'You are in \'detached HEAD\' state. You can look around, make experimental'."\n"
            .'changes and commit them, and you can discard any commits you make in this'."\n"
            .'state without impacting any branches by performing another checkout.'
        );
    }


    /**
     * Get the current refs from the repository.  Will use cached result unless a refresh is requested.
     *
     * @param bool $forceRefresh Force a refresh from the repository
     *
     * @return array
     */
    public function getRefs($forceRefresh = false)
    {
        if (!$forceRefresh && !empty($this->cachedRefs)) {
            return $this->cachedRefs;
        }

        $result = $this->gitCommandWrapper->lsRemote($this->repositoryPath)->execute();

        if (!$result->isSuccess()) {
            throw new RuntimeException(
                'Unable to get ref paths.'."\n".implode($result->getMessage())
            );
        }

        $raw = $result->getMessage();

        foreach ($raw as $ref) {
            list($commit, $refSpec) = explode("\t", $ref);

            if (strpos($refSpec, '^{}') !== false) {
                continue;
            }

            $this->cachedRefs[$refSpec] = $commit;
        }

        return $this->cachedRefs;
    }

    /**
     * Is a remote repo
     *
     * @return bool
     */
    public function isRemote()
    {
        if (@is_dir($this->repositoryPath)) {
            return false;
        }

        $parsed = parse_url($this->repositoryPath);

        if (!empty($parsed['scheme'])
            && ($parsed['scheme'] == 'https' || $parsed['scheme'] == 'http' || $parsed['scheme'] == 'git')
        ) {
            return true;
        }

        if (preg_match('/@.+:/', $this->repositoryPath)) {
            return true;
        }

        return false;
    }

    /**
     * Is the current repo in a detached head state?
     *
     * @return bool
     */
    public function inDetachedHead()
    {
        try {
            $this->getCurrentBranch();
        } catch (DetachedHeadException $e) {
            return true;
        }

        return false;
    }

    /**
     * Get the current working path
     *
     * @return string
     */
    public function getRepositoryPath()
    {
        return $this->repositoryPath;
    }
}
