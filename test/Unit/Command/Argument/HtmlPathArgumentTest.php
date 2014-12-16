<?php
/**
 * Test for the HtmlPath argument
 *
 * This file contains test for the HtmlPath argument
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
 * Test for the HtmlPath argument
 *
 * Test for the HtmlPath argument
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

class HtmlPathArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\HtmlPathArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\HtmlPathArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\HtmlPathArgument', class_uses($this->argument)));
    }

    /**
     * Test HtmlPath
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HtmlPathArgument
     */
    public function testHtmlPath()
    {
        $this->argument->htmlPath();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'htmlPath'));
    }

    /**
     * Test HtmlPath False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HtmlPathArgument
     */
    public function testHtmlPathFalse()
    {
        $this->argument->htmlPath()->htmlPath();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'htmlPath'));
    }


    /**
     * Test the getHtmlPath method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HtmlPathArgument
     */
    public function testGetHtmlPath()
    {
        $expected = ' --html-path';
        $result = $this->argument->htmlPath()->getHtmlPath();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getHtmlPath method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\HtmlPathArgument
     */
    public function testGetHtmlPathReturnsEmptyString()
    {
        $result = $this->argument->getHtmlPath();
        $this->assertEmpty($result);
    }

}
