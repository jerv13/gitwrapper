<?php

/**
 * Fetch Command
 *
 * This file contains the Fetch Command
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

use Reliv\Git\Command\Argument\AllArgument;
use Reliv\Git\Command\Argument\AppendArgument;
use Reliv\Git\Command\Argument\DepthArgument;
use Reliv\Git\Command\Argument\DryRunArgument;
use Reliv\Git\Command\Argument\ForceArgument;
use Reliv\Git\Command\Argument\KeepArgument;
use Reliv\Git\Command\Argument\MultipleArgument;
use Reliv\Git\Command\Argument\ProgressArgument;
use Reliv\Git\Command\Argument\PruneArgument;
use Reliv\Git\Command\Argument\QuietArgument;
use Reliv\Git\Command\Argument\RecurseSubmodulesArgument;
use Reliv\Git\Command\Argument\RefMapArgument;
use Reliv\Git\Command\Argument\TagsArgument;
use Reliv\Git\Command\Argument\UnshallowArgument;
use Reliv\Git\Command\Argument\UpdateShallowArgument;
use Reliv\Git\Command\Argument\UploadPackArgument;
use Reliv\Git\Command\Argument\VerboseArgument;
use Reliv\Git\Exception\InvalidArgumentException;

/**
 * Fetch Command
 *
 * Fetch Command.  Download objects and refs from another repository.
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
class FetchCommand extends CommandAbstract
{
    use AllArgument;
    use AppendArgument;
    use DepthArgument;
    use UnshallowArgument;
    use UpdateShallowArgument;
    use DryRunArgument;
    use ForceArgument;
    use KeepArgument;
    use MultipleArgument;
    use PruneArgument;
    use TagsArgument;
    use RefMapArgument;
    use RecurseSubmodulesArgument;
    use UploadPackArgument;
    use QuietArgument;
    use VerboseArgument;
    use ProgressArgument;

    protected $repositoryOrGroup = '';
    protected $refspec           = '';

    /**
     * Constructor
     *
     * @param CommandInterface $parent            Command to wrap
     * @param null             $repositoryOrGroup Repository path/url or group name
     * @param null             $refspec           Refspec.  Do not use when fetching a group.
     */
    public function __construct(
        CommandInterface $parent,
        $repositoryOrGroup = null,
        $refspec = null
    ) {
        parent::__construct($parent);

        if ($refspec && !$repositoryOrGroup) {
            throw new InvalidArgumentException(
                'A repository name or path must be provided when using a refspec.'
                .' See `git fetch help` for more information'
            );
        }

        $this->repositoryOrGroup = $repositoryOrGroup;
        $this->refspec=$refspec;
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' fetch';
        $cmd .= $this->getAll();
        $cmd .= $this->getAppend();
        $cmd .= $this->getDepth();
        $cmd .= $this->getUnshallow();
        $cmd .= $this->getUpdateShallow();
        $cmd .= $this->getDryRun();
        $cmd .= $this->getForce();
        $cmd .= $this->getKeep();
        $cmd .= $this->getMultiple();
        $cmd .= $this->getPrune();
        $cmd .= $this->getTags();
        $cmd .= $this->getRefMap();
        $cmd .= $this->getRecurseSubmodules();
        $cmd .= $this->getUploadPack();
        $cmd .= $this->getQuiet();
        $cmd .= $this->getVerbose();
        $cmd .= $this->getProgress();

        if (!empty($this->repositoryOrGroup)) {
            $cmd .= ' '.escapeshellarg($this->repositoryOrGroup);
        }

        if (!empty($this->repositoryOrGroup) && !empty($this->refspec)) {
            $cmd .= ' '.escapeshellarg($this->refspec);
        }

        return $cmd;
    }
}
