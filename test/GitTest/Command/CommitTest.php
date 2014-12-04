<?php
/**
 * Test for the Commit command
 *
 * This file contains test for the Commit command
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

use Git\Command\Commit;

require_once __DIR__ . '/Base.php';

/**
 * Test for the Commit command
 *
 * Test for the Commit command
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

class CommitTest extends Base
{
    /** @var \Git\Command\Commit */
    protected $command;

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Git\Command\Commit
     */
    public function testConstructor()
    {
        $config = $this->getConfig();
        $this->assertTrue($this->command instanceof Commit);
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
     * @covers \Git\Command\Commit
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
     * @covers \Git\Command\Commit
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
     * @covers \Git\Command\Commit
     */
    public function testExecute()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
