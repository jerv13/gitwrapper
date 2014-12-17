<?php
/**
 * Shared Argument
 *
 * This file contains the Shared Argument for Commands
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
 * Shared Argument
 *
 * Shared Argument.
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
trait SharedArgument
{
    protected $shared = 'umask';

    /**
     * Specify that the Git repository is to be shared
     * amongst several users. This allows users belonging
     * to the same group to push into that repository.
     * When specified, the config variable
     * "core.sharedRepository" is set so that files and
     * directories under $GIT_DIR are created with the
     * requested permissions. When not specified, Git
     * will use permissions reported by umask(2).
     *
     * The option can have the following values, defaulting
     * to group if no value is given:
     *     umask (or false)            : Use permissions reported by umask(2).
     *                                   The default, when --shared is not specified.
     *     group (or true)             : Make the repository group-writable,
     *                                   (and g+sx, since the git group may be not
     *                                   the primary group of all users). This is used
     *                                   to loosen the permissions of an otherwise safe
     *                                   umask(2) value. Note that the umask still
     *                                   applies to the other permission bits (e.g.
     *                                   if umask is 0022, using group will not remove
     *                                   read privileges from other (non-group) users).
     *                                   See 0xxx for how to exactly specify the
     *                                   repository permissions.
     *     all (or world or everybody) : Same as group, but make the repository readable
     *                                   by all users.
     *     0xxx                        : 0xxx is an octal number and each file will have
     *                                   mode 0xxx. 0xxx will override users' umask(2)
     *                                   value (and not only loosen permissions as group
     *                                   and all does). 0640 will create a repository
     *                                   which is group-readable, but not group-writable
     *                                   or accessible to others. 0660 will create a
     *                                   repo that is readable and writable to the
     *                                   current user and group, but inaccessible to
     *                                   others.
     *
     * By default, the configuration flag
     * receive.denyNonFastForwards is enabled in shared
     * repositories, so that you cannot force a non
     * fast-forwarding push into it.
     *
     * If you provide a directory, the command is run
     * inside it. If this directory does not exist, it
     * will be created.
     *
     * @param string $value false|true|umask|group|all|world|everybody|0xxx
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function shared($value = 'group')
    {
        if (empty($value) && $value !== false) {
            $value = 'group';
        } elseif (empty($value) && $value === false) {
            $value = 'umask';
        } elseif ($value === true || $value == 'true') {
            $value = 'group';
        } elseif ($value == 'world' || $value == 'everybody') {
            $value = 'all';
        }

        $allowed = array(
            'true',
            'false',
            'umask',
            'group',
            'all',
            'world',
            'everybody'
        );

        if (!is_numeric($value) && !in_array($value, $allowed)) {
            throw new InvalidArgumentException(
                'Invalid shared property.  Allowed: '.implode(', ', $allowed).', 0xxx'
            );
        }

        $this->shared = $value;
        return $this;
    }

    /**
     * Get the command line parameter
     *
     * @return string
     */
    public function getShared()
    {
        $cmd = '';

        if ($this->shared !== 'umask') {
            $cmd .= ' --shared='.escapeshellarg($this->shared);
        }

        return $cmd;
    }
}
