<?php
/**
 * RunInPath Argument
 *
 * This file contains the RunInPath Argument for Commands
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

use Reliv\Git\Exception\DirectoryNotFoundException;

/**
 * RunInPath Argument
 *
 * RunInPath Argument.
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
trait RunInPathArgument
{
    protected $runInPath = '';

    /**
     * -C command, renamed to runInPath due to PHP case insensitive nature.
     *
     * Run as if git was started in <path> instead of the current working
     * directory. When multiple -C options are given, each subsequent
     * non-absolute -C <path> is interpreted relative to the preceding -C
     * <path>.
     *
     * This option affects options that expect path name like --git-dir
     * and --work-tree in that their interpretations of the path names
     * would be made relative to the working directory caused by the -C
     * option. For example the following invocations are equivalent:
     * <code>
     *     git --git-dir=a.git --work-tree=b -C c status
     *     git --git-dir=c/a.git --work-tree=c/b status
     * </code>
     *
     * @param string $path Path to run git from.
     *
     * @return $this
     */
    public function runInPath($path)
    {
        if (!empty($path) && !is_dir($path)) {
            throw new DirectoryNotFoundException('No directory found at: '.$path);
        } elseif (empty($path)) {
            $path = '';
        }

        $this->runInPath = $path;

        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getRunInPath()
    {
        $cmd = '';

        if (!empty($this->runInPath)) {
            $cmd .= ' -C '.escapeshellarg($this->runInPath);
        }

        return $cmd;
    }
}
