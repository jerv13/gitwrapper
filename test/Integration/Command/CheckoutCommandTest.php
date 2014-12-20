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

namespace Reliv\GitTest\Integration\Command;

use Reliv\Git\Command\CheckoutCommand;
use Reliv\Git\Command\GitCommand;

require_once __DIR__ . '/Base.php';

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

class CheckoutCommandTest extends Base
{
    /** @var \Reliv\Git\Command\CheckoutCommand */
    protected $command;

    protected $currentDir;

    public function setup()
    {
        $config = $this->getConfig();

        $this->gitCommandWrapper = new GitCommand($config['gitPath']);

        $this->command = new CheckoutCommand($this->gitCommandWrapper, 'master');

        $this->initTempDir();
        $this->initGitRepositories();

        $config = $this->getConfig();
        $workingClone   = $config['tempFolder'].$config['workingClone'];

        $this->currentDir = getcwd();
        chdir($workingClone);
    }

    /**
     * Tear Down
     */
    public function tearDown()
    {
        chdir($this->currentDir);
    }

    /**
     * Test Execution of command
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\CheckoutCommand
     */
    public function testExecute()
    {
        $result = $this->command->b('checkoutTestBranch')->execute();
        $this->assertTrue($result->isSuccess());
        $this->assertContains('checkoutTestBranch', $result->getErrors()[0]);
    }
}
