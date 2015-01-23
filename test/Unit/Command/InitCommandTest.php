<?php
/**
 * Test for the Init command
 *
 * This file contains test for the Init command
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

use Reliv\Git\Command\InitCommand;
use Reliv\GitTest\Unit\UnitBase;

require_once __DIR__ . '/../UnitBase.php';

/**
 * Test for the Init command
 *
 * Test for the Init command
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

class InitCommandTest extends UnitBase
{
    /** @var \Reliv\Git\Command\InitCommand */
    protected $command;

    /**
     * Test the constructor
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testConstructor()
    {
        $this->assertTrue($this->command instanceof InitCommand);
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
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testGetCommand()
    {
        $expected = $this->config['gitPath'].' init';
        $result = $this->command->getCommand();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the get command with all options turned on
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\InitCommand
     */
    public function testGetCommandAllOptions()
    {
        $path = $this->config['tempFolder'];

        $expected = $this->config['gitPath']
            .' init'
            .' --quiet'
            .' --bare'
            .' --template='.escapeshellarg($path)
            .' --separate-git-dir='.escapeshellarg($path)
            .' --shared='.escapeshellarg('group');

        $result = $this->command
            ->quiet()
            ->bare()
            ->template($path)
            ->separateGitDir($path)
            ->shared()
            ->getCommand();

        $this->assertEquals($expected, $result);
    }
}
