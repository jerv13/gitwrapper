<?php
/**
 * Test for the Verbose argument
 *
 * This file contains test for the Verbose argument
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
 * Test for the Verbose argument
 *
 * Test for the Verbose argument
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

class VerboseArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\VerboseArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\VerboseArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\VerboseArgument', class_uses($this->argument)));
    }

    /**
     * Test the default value
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\VerboseArgument
     */
    public function testVerboseDefault()
    {
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'verbose'));
    }

    /**
     * Test the verbose method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\VerboseArgument
     */
    public function testVerbose()
    {
        $this->argument->verbose();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'verbose'));
    }

    /**
     * Test the verbose method false
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\VerboseArgument
     */
    public function testVerboseFalse()
    {
        $this->argument->verbose()->verbose();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'verbose'));
    }

    /**
     * Test the getVerbose method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\VerboseArgument
     */
    public function testGetVerbose()
    {
        $expected = ' --verbose';
        $result = $this->argument->verbose()->getVerbose();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getVerbose method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\VerboseArgument
     */
    public function testGetVerboseReturnsEmptyString()
    {
        $result = $this->argument->getVerbose();
        $this->assertEmpty($result);
    }

}
