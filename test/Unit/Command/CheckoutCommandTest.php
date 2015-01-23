<?php
/**
 * Test for the Checkout command
 *
 * This file contains test for the Checkout command
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

namespace Reliv\GitTest\Unit\Command;

use Reliv\Git\Command\CheckoutCommand;
use Reliv\GitTest\Unit\UnitBase;

require_once __DIR__ . '/../UnitBase.php';

/**
 * Test for the Checkout command
 *
 * Test for the Checkout command
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

class CheckoutCommandTest extends UnitBase
{
    /** @var \Reliv\Git\Command\CheckoutCommand */
    protected $command;

    /**
     * Setup for tests
     *
     * @return void
     */
    public function setup()
    {
        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Reliv\Git\Command\GitCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $this->command = new CheckoutCommand($gitMock, 'branch');
    }

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\CheckoutCommand
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof CheckoutCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\CheckoutCommand
     */
    public function testGetCommand()
    {
        $config = $this->getConfig();
        $expected = $config['gitPath'].' checkout \'branch\'';

        $result = $this->command->getCommand();
        $this->assertEquals(
            $expected,
            $result
        );
    }
}
