<?php
/**
 * Column Argument
 *
 * This file contains the Column Argument for Commands
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
 * Column Argument
 *
 * Column Argument.
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
trait ColumnArgument
{
    protected $column   = '';
    protected $noColumn = '';

    /**
     * Display untracked files in columns. --column and
     * --no-column without options are equivalent to always and
     * never respectively.
     *
     * These options control when the feature should be enabled
     * (defaults to never):
     *     always  - always show in columns
     *     never   - never show in columns
     *     auto    - show in columns if the output is to the terminal
     *
     * These options control layout (defaults to column). Setting
     * any of these implies always if none of always, never, or auto
     * are specified.
     *     column  - fill columns before rows
     *     row     - fill rows before columns
     *     plain   - show in one column
     *
     * Finally, these options can be combined with a layout option
     * (defaults to nodense):
     *     dense   - make unequal size columns to utilize more space
     *     nodense - make equal size columns
     *
     * @param array $options List of options. Available options:
     *                       always, never, auto, column, row, plain
     *                       dense, nodense
     *
     * @return $this
     */
    public function column(Array $options)
    {
        $allowed = array(
            'always',
            'never',
            'auto',
            'column',
            'row',
            'plain',
            'dense',
            'nodense',
        );

        foreach ($options as $key => &$option) {
            $option = strtolower($option);

            if (empty($option) || !in_array($option, $allowed)) {
                throw new InvalidArgumentException(
                    'Invalid option passed for column.  Available'
                    .' options: always, never, auto, column, row, plain'
                    .' dense, nodense'
                );
            }
        }

        $this->column = implode(',', $options);
        $this->noColumn = false;
        return $this;
    }

    /**
     * Do not display untracked files in columns.  This command
     * is the equivalent of calling --column=never
     *
     * @return $this
     */
    public function noColumn()
    {
        $this->noColumn = !$this->noColumn;
        $this->column = array();
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getColumn()
    {
        $cmd = '';

        if ($this->column) {
            $cmd .= ' --column='.escapeshellarg($this->column);
        }

        if ($this->noColumn) {
            $cmd .= ' --no-column';
        }

        return $cmd;
    }
}
