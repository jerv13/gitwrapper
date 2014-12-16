<?php
/**
 * UploadPack Argument
 *
 * This file contains the UploadPack Argument for Commands
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
 * UploadPack Argument
 *
 * UploadPack Argument.
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
trait UploadPackArgument
{
    protected $uploadPack = '';

    /**
     * When given, and the repository to clone from is accessed via ssh,
     * this specifies a non-default path for the command run on the other
     * end.
     *
     * @param string $path Path to non-default git-upload-pack command
     *
     * @return $this
     */
    public function uploadPack($path)
    {
        if (empty($path)) {
            $path = '';
        }

        $this->uploadPack = $path;
        return $this;
    }

    /**
     * Alias of uploadPack
     *
     * @param string $path Path to non-default git-upload-pack command
     *
     * @return $this
     */
    public function u($path)
    {
        return $this->uploadPack($path);
    }


    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getUploadPack()
    {
        $cmd = '';

        if (!empty($this->uploadPack)) {
            $cmd .= ' --upload-pack='.escapeshellarg($this->uploadPack);
        }

        return $cmd;
    }
}
