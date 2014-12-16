<?php

/**
 * Clone Command
 *
 * This file contains the Clone Command
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

use Reliv\Git\Command\Argument\BareArgument;
use Reliv\Git\Command\Argument\BranchArgument;
use Reliv\Git\Command\Argument\ConfigArgument;
use Reliv\Git\Command\Argument\LocalArgument;
use Reliv\Git\Command\Argument\MirrorArgument;
use Reliv\Git\Command\Argument\NoCheckoutArgument;
use Reliv\Git\Command\Argument\NoHardLinksArgument;
use Reliv\Git\Command\Argument\OriginArgument;
use Reliv\Git\Command\Argument\ProgressArgument;
use Reliv\Git\Command\Argument\DepthArgument;
use Reliv\Git\Command\Argument\QuietArgument;
use Reliv\Git\Command\Argument\RecursiveArgument;
use Reliv\Git\Command\Argument\ReferenceArgument;
use Reliv\Git\Command\Argument\SeparateGitDirArgument;
use Reliv\Git\Command\Argument\SharedArgument;
use Reliv\Git\Command\Argument\SingleBranchArgument;
use Reliv\Git\Command\Argument\TemplateArgument;
use Reliv\Git\Command\Argument\UploadPackArgument;
use Reliv\Git\Command\Argument\VerboseArgument;
use Reliv\Git\Exception\InvalidArgumentException;

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
class CloneCommand extends CommandAbstract
{
    use DepthArgument;
    use ProgressArgument;
    use QuietArgument;
    use LocalArgument;
    use NoHardLinksArgument;
    use SharedArgument;
    use ReferenceArgument;
    use VerboseArgument;
    use NoCheckoutArgument;
    use BareArgument;
    use MirrorArgument;
    use OriginArgument;
    use BranchArgument;
    use UploadPackArgument;
    use TemplateArgument;
    use ConfigArgument;
    use SingleBranchArgument;
    use RecursiveArgument;
    use SeparateGitDirArgument;

    protected $remote         = '';
    protected $toDir          = '';

    /**
     * Constructor.
     *
     * @param CommandInterface $parent Command to wrap
     * @param string           $from   URI to Git repo to clone
     * @param string           $toDir  Directory to clone to.
     *
     * @throws InvalidArgumentException
     */
    public function __construct(CommandInterface $parent, $from, $toDir = null)
    {
        parent::__construct($parent);

        if (empty($from)) {
            throw new InvalidArgumentException(
                'No source repository found in calling arguments.'
            );
        }

        $this->remote = $from;

        if (!empty($toDir)) {
            $this->toDir = $toDir;
        }
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' clone';
        $cmd .= $this->getLocal();
        $cmd .= $this->getNoHardLinks();
        $cmd .= $this->getShared();
        $cmd .= $this->getReference();
        $cmd .= $this->getQuiet();
        $cmd .= $this->getVerbose();
        $cmd .= $this->getProgress();
        $cmd .= $this->getNoCheckout();
        $cmd .= $this->getBare();
        $cmd .= $this->getMirror();
        $cmd .= $this->getOrigin();
        $cmd .= $this->getBranch();
        $cmd .= $this->getUploadPack();
        $cmd .= $this->getTemplate();
        $cmd .= $this->getConfig();
        $cmd .= $this->getDepth();
        $cmd .= $this->getSingleBranch();
        $cmd .= $this->getRecursive();
        $cmd .= $this->getSeparateGitDir();

        $cmd .= ' '.escapeshellarg($this->remote);

        if (!empty($this->toDir)) {
            $cmd .= ' '.escapeshellarg($this->toDir);
        }

        return $cmd;
    }
}
