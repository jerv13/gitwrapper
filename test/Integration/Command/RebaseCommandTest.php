<?php
/**
 * Test for the Rebase command
 *
 * This file contains test for the Rebase command
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

namespace Reliv\GitTest\Integration\Command;

use Reliv\Git\Command\RebaseCommand;
use Reliv\GitTest\Integration\Base;

require_once __DIR__ . '/../Base.php';

/**
 * Test for the Rebase command
 *
 * Test for the Rebase command
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

class RebaseCommandTest extends Base
{
    /** @var \Reliv\Git\Command\RebaseCommand */
    protected $command;

    /**
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\RebaseCommand
     */
    public function testExecute()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
