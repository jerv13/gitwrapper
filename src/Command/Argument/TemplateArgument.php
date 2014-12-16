<?php
/**
 * Template Argument
 *
 * This file contains the Template Argument for Commands
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
 * Template Argument
 *
 * Template Argument.
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
trait TemplateArgument
{
    protected $template = '';

    /**
     * Specify the directory from which templates will be used.
     *
     * @param string $path Directory of templates
     *
     * @return $this
     * @throws DirectoryNotFoundException
     */
    public function template($path)
    {
        if (!empty($path) && !is_dir($path)) {
            throw new DirectoryNotFoundException('No directory found at: '.$path);
        } elseif (empty($path)) {
            $path = '';
        }

        $this->template = $path;

        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getTemplate()
    {
        $cmd = '';

        if (!empty($this->template)) {
            $cmd .= ' --template='.escapeshellarg($this->template);
        }

        return $cmd;
    }
}
