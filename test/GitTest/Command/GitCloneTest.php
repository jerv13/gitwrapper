<?php
/**
 * Test for the GitClone command
 *
 * This file contains test for the GitClone command
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

namespace GitTest\Command;

use Git\Command\GitClone;

require_once __DIR__ . '/Base.php';

/**
 * Test for the GitClone command
 *
 * Test for the GitClone command
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

class GitCloneTest extends Base
{
    /** @var \Git\Command\GitClone */
    protected $command;

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testConstructor()
    {
        $config = $this->getConfig();
        $this->assertTrue($this->command instanceof GitClone);
        $this->assertEquals(
            $config['gitPath'],
            \PHPUnit_Framework_Assert::readAttribute($this->command, 'wrappedCommand')
        );
    }

    /**
     * Test the class default values
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
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
     * @covers \Git\Command\GitClone
     */
    public function testGetCommand()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Git\Command\GitClone
     */
    public function testExecute()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
