<?php
/**
 * Test for the Merge command
 *
 * This file contains test for the Merge command
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

use Reliv\Git\Command\MergeCommand;

require_once __DIR__ . '/Base.php';

/**
 * Test for the Merge command
 *
 * Test for the Merge command
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

class MergeCommandTest extends Base
{
    /** @var \Reliv\Git\Command\MergeCommand */
    protected $command;

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\MergeCommand
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof MergeCommand);
        $this->assertInstanceOf(
            '\Reliv\Git\Command\CommandInterface',
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );
    }

    /**
     * Test the class default values
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\MergeCommand
     */
    public function testDefaults()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Test the get command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\MergeCommand
     */
    public function testGetCommand()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
