<?php
/**
 * Test for the Reset command
 *
 * This file contains test for the Reset command
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

namespace GitTest\Integration\Command;

use Git\Command\Reset;

require_once __DIR__ . '/Base.php';

/**
 * Test for the Reset command
 *
 * Test for the Reset command
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

class ResetTest extends Base
{
    /** @var \Git\Command\Reset */
    protected $command;

    /**
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Git\Command\Reset
     */
    public function testExecute()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
