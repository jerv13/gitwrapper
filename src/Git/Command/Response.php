<?php

/**
 * Command Response
 *
 * This file contains the Command Response
 *
 * PHP version 5.3
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

namespace Git\Command;

/**
 * Command Response
 *
 * Command Response.  Response object that all commands return.  This allows all commands to return a known response
 * to all calling applications
 *
 * PHP version 5.3
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
class Response
{
    protected $statusCode = 500;
    protected $message = array();

    /**
     * Get Returned Message
     *
     * @return array
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the Returned Message
     *
     * @param array $message Message returned from command
     *
     * @return void
     */
    public function setMessage(Array $message)
    {
        $this->message = array_merge($this->message, $message);
    }

    /**
     * Get the status code
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set the status code
     *
     * @param int $statusCode Status code returned from command
     *
     * @return void
     */
    public function setStatusCode($statusCode)
    {
        if ((empty($statusCode) && $statusCode !== 0) || !is_numeric($statusCode)) {
            throw new InvalidArgumentException('Status code must be a numerical number');
        }

        $this->statusCode = $statusCode;
    }

    /**
     * Was the command successful?
     *
     * @return bool
     */
    public function isSuccess()
    {
        if ($this->statusCode === 0) {
            return true;
        }

        return false;
    }
}
