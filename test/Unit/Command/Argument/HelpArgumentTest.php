<?php
/**
 * Test for the Help argument
 *
 * This file contains test for the Help argument
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
 * Test for the Help argument
 *
 * Test for the Help argument
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

class HelpArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\HelpArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\HelpArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\HelpArgument', class_uses($this->argument)));
    }

    /**
     * Test Help
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HelpArgument
     */
    public function testHelp()
    {
        $this->argument->help();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'help'));
    }

    /**
     * Test Help False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HelpArgument
     */
    public function testHelpFalse()
    {
        $this->argument->help()->help();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'help'));
    }


    /**
     * Test the getHelp method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HelpArgument
     */
    public function testGetHelp()
    {
        $expected = ' --help';
        $result = $this->argument->help()->getHelp();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getHelp method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HelpArgument
     */
    public function testGetHelpReturnsEmptyString()
    {
        $result = $this->argument->getHelp();
        $this->assertEmpty($result);
    }

}
