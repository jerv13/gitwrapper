<?php
/**
 * Test for the Version argument
 *
 * This file contains test for the Version argument
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
 * Test for the Version argument
 *
 * Test for the Version argument
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

class VersionArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\VersionArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\VersionArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\VersionArgument', class_uses($this->argument)));
    }

    /**
     * Test Version
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\VersionArgument
     */
    public function testVersion()
    {
        $this->argument->version();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'version'));
    }

    /**
     * Test Version False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\VersionArgument
     */
    public function testVersionFalse()
    {
        $this->argument->version()->version();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'version'));
    }


    /**
     * Test the getVersion method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\VersionArgument
     */
    public function testGetVersion()
    {
        $expected = ' --version';
        $result = $this->argument->version()->getVersion();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getVersion method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\VersionArgument
     */
    public function testGetVersionReturnsEmptyString()
    {
        $result = $this->argument->getVersion();
        $this->assertEmpty($result);
    }
}
