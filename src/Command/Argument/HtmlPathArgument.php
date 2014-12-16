<?php
/**
 * HtmlPath Argument
 *
 * This file contains the HtmlPath Argument for Commands
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
 * HtmlPath Argument
 *
 * HtmlPath Argument.
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
trait HtmlPathArgument
{
    protected $htmlPath = false;

    /**
     * Print the path, without trailing slash, where Git's HTML
     * documentation is installed and exit.
     *
     * @return $this
     */
    public function htmlPath()
    {
        $this->htmlPath = !$this->htmlPath;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getHtmlPath()
    {
        $cmd = '';

        if ($this->htmlPath) {
            $cmd .= ' --html-path';
        }

        return $cmd;
    }
}
