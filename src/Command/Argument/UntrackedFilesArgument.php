<?php
/**
 * UntrackedFiles Argument
 *
 * This file contains the UntrackedFiles Argument for Commands
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

use Reliv\Git\Exception\InvalidArgumentException;

/**
 * UntrackedFiles Argument
 *
 * UntrackedFiles Argument.
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
trait UntrackedFilesArgument
{
    protected $untrackedFiles   = '';

    /**
     * Show untracked files.
     *
     * The mode parameter is optional (defaults to all), and is used to
     * specify the handling of untracked files.
     * The possible options are:
     *     no - Show no untracked files.
     *     normal - Shows untracked files and directories.
     *     all - Also shows individual files in untracked directories.
     *
     * When -u option is not used, untracked files and directories are
     * shown (i.e. the same as specifying normal), to help you avoid
     * forgetting to add newly created files. Because it takes extra
     * work to find untracked files in the filesystem, this mode may
     * take some time in a large working tree. You can use no to have
     * git status return more quickly without showing untracked files.
     *
     * The default can be changed using the status.showUntrackedFiles
     * configuration variable documented in git-config(1).
     *
     * @param string $mode Mode.  Allowed: no, normal or all
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function untrackedFiles($mode = 'all')
    {
        $allowed = array(
            'no',
            'normal',
            'all'
        );

        $mode = strtolower($mode);

        if (!empty($mode) && !in_array($mode, $allowed)) {
            throw new InvalidArgumentException(
                'Invalid mode.  Allowed: no, normal or all'
            );
        } elseif (empty($mode)) {
            $mode = '';
        }

        $this->untrackedFiles = $mode;
        return $this;
    }

    /**
     * Alias of untrackedFiles
     *
     * @param string $mode Mode.  Allowed: no, normal or all
     *
     * @return $this
     */
    public function u($mode = 'all')
    {
        return $this->untrackedFiles($mode);
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getUntrackedFiles()
    {
        $cmd = '';

        if ($this->untrackedFiles) {
            $cmd .= ' --untracked-files='.escapeshellarg($this->untrackedFiles);
        }

        return $cmd;
    }
}
