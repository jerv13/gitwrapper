<?php
/**
 * Test for the ExitCode argument
 *
 * This file contains test for the ExitCode argument
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

namespace Reliv\GitTest\Unit\Command\Argument;

require_once __DIR__ . '/../../../autoload.php';


/**
 * Test for the ExitCode argument
 *
 * Test for the ExitCode argument
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

class ExitCodeArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\ExitCodeArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ExitCodeArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ExitCodeArgument', class_uses($this->argument)));
    }

    /**
     * Test ExitCode
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ExitCodeArgument
     */
    public function testExitCode()
    {
        $this->argument->exitCode();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'exitCode'));
    }

    /**
     * Test ExitCode False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ExitCodeArgument
     */
    public function testExitCodeFalse()
    {
        $this->argument->exitCode()->exitCode();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'exitCode'));
    }

    /**
     * Test the getExitCode method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ExitCodeArgument
     */
    public function testGetExitCode()
    {
        $expected = ' --exit-code';
        $result = $this->argument->exitCode()->getExitCode();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getExitCode method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ExitCodeArgument
     */
    public function testGetExitCodeReturnsEmptyString()
    {
        $result = $this->argument->getExitCode();
        $this->assertEmpty($result);
    }
}
