<?php
/**
 * Test for the Fetch command
 *
 * This file contains test for the Fetch command
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
use Reliv\GitTest\Integration\Base;

require_once __DIR__ . '/../Base.php';

/**
 * Test for the Fetch command
 *
 * Test for the Fetch command
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

class FetchCommandTest extends Base
{
    /** @var \Reliv\Git\Command\FetchCommand */
    protected $command;

    protected $currentDir;

    public function setup()
    {
        parent::setup();

        $this->initTempDir();
        $this->initGitRepositories();

        $config = $this->getConfig();
        $outOfDateRepo   = $config['tempFolder'].$config['outOfDateClone'];

        $this->currentDir = getcwd();
        chdir($outOfDateRepo);
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
     * @covers \Reliv\Git\Command\FetchCommand
     */
    public function testExecute()
    {
        $response = $this->command->all()->execute();

        $this->assertTrue($response->isSuccess());
        $this->assertEquals(
            'Fetching origin',
            $response->getMessage()[0]
        );
    }
}
