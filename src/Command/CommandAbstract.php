<?php

/**
 * Command Abstract
 *
 * This file contains the Command Abstract
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

/**
 * Command Abstract
 *
 * Command Abstract.  Common methods used by all commands
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
abstract class CommandAbstract implements CommandInterface
{
    /**
     * @var string Command to execute
     */
    protected $wrappedCommand;

    /**
     * @var string Path to Git repository
     */
    protected $repositoryPath;

    /**
     * Constructor.
     *
     * @param CommandInterface $parent Command to wrap
     */
    public function __construct(CommandInterface $parent)
    {
        $this->wrappedCommand = $parent;
    }

    /**
     * Get the command string to be used by the CLI
     *
     * @return mixed
     */
    public function getCommand()
    {
        $cmd = '';

        if ($this->wrappedCommand instanceof CommandInterface) {
            $cmd = $this->wrappedCommand->getCommand();
        }

        return $cmd;
    }


    /**
     * Execute the command.  Must return the Command Response object
     *
     * @return CommandResponse
     */
    public function execute()
    {
        $response = new CommandResponse();

        $command = $this->getCommand();

        $message = '';
        $statusCode = null;

        $descriptorspec = array(
            0 => array("pipe", "r"),
            1 => array("pipe", "w"),
            2 => array("pipe", "w")
        );

        $process = proc_open($command, $descriptorspec, $pipes);

        if (is_resource($process)) {

            $message = trim(stream_get_contents($pipes[1]));
            $errors = trim(stream_get_contents($pipes[2]));

            fclose($pipes[0]);
            fclose($pipes[1]);
            fclose($pipes[2]);

            $response->setStatusCode(proc_close($process));
        }

        if (!empty($message)) {
            $response->setMessage(explode("\n", $message));
        }

        if (!empty($errors)) {
            $response->setErrors(explode("\n",$errors));
        }

        return $response;
    }
}
