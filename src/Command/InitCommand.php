<?php

/**
 * Init Command
 *
 * This file contains the Init Command
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
use Reliv\Git\Command\Argument\QuietArgument;
use Reliv\Git\Command\Argument\SeparateGitDirArgument;
use Reliv\Git\Command\Argument\SharedArgument;
use Reliv\Git\Command\Argument\TemplateArgument;
use Reliv\Git\Exception\DirectoryNotFoundException;
use Reliv\Git\Exception\InvalidArgumentException;

/**
 * Init Command
 *
 * Init Command.  Create an empty Git repository or reinitialize an existing one
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
class InitCommand extends CommandAbstract
{
    use QuietArgument;
    use BareArgument;
    use TemplateArgument;
    use SeparateGitDirArgument;
    use SharedArgument;

    /**
     * Get the command string to be used by the CLI
     *
     * @return string
     */
    public function getCommand()
    {
        $cmd = parent::getCommand().' init';
        $cmd .= $this->getQuiet();
        $cmd .= $this->getBare();
        $cmd .= $this->getTemplate();
        $cmd .= $this->getSeparateGitDir();
        $cmd .= $this->getShared();

        return $cmd;
    }
}
