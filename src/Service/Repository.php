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
    }

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

    public function inDetachedHead()
    {
        try {
            $this->getCurrentBranch();
        } catch (DetachedHeadException $e) {
            return true;
        }

        return false;
    }
}
