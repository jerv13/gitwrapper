<?php

/**
 * RemoteRename Command
 *
 * This file contains the RemoteRename Command
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

use Reliv\Git\Command\Argument\NoTagsArgument;
use Reliv\Git\Command\Argument\TagsArgument;

/**
 * RemoteRename Command
 *
 * RemoteRename Command.  Add a remote
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
class RemoteRenameCommand extends CommandAbstract
{

    use TagsArgument;
    use NoTagsArgument;


    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' add';
        $cmd .= $this->getTags();
        $cmd .= $this->getNoTags();
        return $cmd;
    }
}
