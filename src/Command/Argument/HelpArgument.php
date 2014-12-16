<?php
/**
 * Help Argument
 *
 * This file contains the Help Argument for Commands
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

namespace Reliv\Git\Command\Argument;

/**
 * Help Argument
 *
 * Help Argument.
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
trait HelpArgument
{
    protected $help = false;

    /**
     * Prints the synopsis and a list of the most commonly used commands.
     * If the option --all or -a is given then all available commands are
     * printed. If a Git command is named this option will bring up the
     * manual page for that command.
     *
     * Other options are available to control how the manual page is
     * displayed. See git-help(1) for more information, because git --help
     * ...  is converted internally into git help ....
     *
     * @return $this
     */
    public function help()
    {
        $this->help = !$this->help;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getHelp()
    {
        $cmd = '';

        if ($this->help) {
            $cmd .= ' --help';
        }

        return $cmd;
    }
}
