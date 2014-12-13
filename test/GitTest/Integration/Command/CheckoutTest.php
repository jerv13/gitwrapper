<?php
/**
 * Test for the Checkout command
 *
 * This file contains test for the Checkout command
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

use Git\Command\Checkout;

require_once __DIR__ . '/Base.php';

/**
 * Test for the Checkout command
 *
 * Test for the Checkout command
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

class CheckoutTest extends Base
{
    /** @var \Git\Command\Checkout */
    protected $command;

    /**
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Git\Command\Checkout
     */
    public function testExecute()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
