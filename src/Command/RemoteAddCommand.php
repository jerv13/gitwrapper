<?php

/**
 * RemoteAdd Command
 *
 * This file contains the RemoteAdd Command
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
 * RemoteAdd Command
 *
 * RemoteAdd Command.  Add a remote
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
class RemoteAddCommand extends CommandAbstract
{

    use TagsArgument;
    use NoTagsArgument;

    protected $name;
    protected $url;

    /**
     * Constructor.
     *
     * @param CommandInterface $parent Command to wrap
     * @param string           $name   Name of Remote
     * @param string           $url    Url to repository
     */
    public function __construct(CommandInterface $parent, $name, $url)
    {
        parent::__construct($parent);
        $this->name = $name;
        $this->url = $url;
    }

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

        $cmd .= ' '.escapeshellarg($this->name);
        $cmd .= ' '.escapeshellarg($this->url);

        return $cmd;
    }
}
