<?php
/**
 * Test for the command response object
 *
 * This file contains test for the command response object
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

namespace GitTest\Unit\Command;

use Git\Command\Response;

require_once __DIR__ . '/../../../autoload.php';


/**
 * Test for the command response object
 *
 * Test for the command response object
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

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Git\Command\Response */
    protected $response;

    /**
     * Setup Tests
     *
     * @return void
     */
    public function setup()
    {
        $this->response = new Response();
    }

    /**
     * Test the Getter and Setter for message
     *
     * @return void
     *
     * @covers \Git\Command\Response
     */
    public function testSetAndGetMessage()
    {
        $message = array(
            'test1',
            'test2',
            'test3'
        );

        $this->response->setMessage($message);

        $result = $this->response->getMessage();

        $this->assertEquals($message, $result);
    }

    /**
     * Test the message setter only accepts arrays
     *
     * @return void
     *
     * @covers \Git\Command\Response
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testSetMessageInvalidData()
    {
        $message = 'test1';
        $this->response->setMessage($message);
    }

    /**
     * Test the Getter and Setter for status code
     *
     * @return void
     *
     * @covers \Git\Command\Response
     */
    public function testSetAndGetStatusCode()
    {
        $statusCode = 0;

        $this->response->setStatusCode($statusCode);

        $result = $this->response->getStatusCode();

        $this->assertEquals($statusCode, $result);
    }

    /**
     * Test the status code setter only accepts numbers
     *
     * @return void
     *
     * @covers \Git\Command\Response
     * @expectedException \Git\Exception\InvalidArgumentException
     */
    public function testSetStatusCodeInvalidData()
    {
        $message = 'test1';
        $this->response->setStatusCode($message);
    }

    /**
     * Test Successful Response
     *
     * @covers \Git\Command\Response
     */
    public function testIsSuccessTrue()
    {
        $this->response->setStatusCode(0);
        $this->assertTrue($this->response->isSuccess());
    }

    /**
     * Test Failed Response
     *
     * @covers \Git\Command\Response
     */
    public function testIsSuccessFalse()
    {
        $this->response->setStatusCode(1);
        $this->assertFalse($this->response->isSuccess());
    }
}
