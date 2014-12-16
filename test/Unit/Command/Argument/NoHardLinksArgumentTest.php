<?php
/**
 * Test for the NoHardLinks argument
 *
 * This file contains test for the NoHardLinks argument
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
 * Test for the NoHardLinks argument
 *
 * Test for the NoHardLinks argument
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

class NoHardLinksArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\NoHardLinksArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\NoHardLinksArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\NoHardLinksArgument', class_uses($this->argument)));
    }

    /**
     * Test NoHardLinks
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoHardLinksArgument
     */
    public function testNoHardLinks()
    {
        $this->argument->noHardLinks();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noHardLinks'));
    }

    /**
     * Test NoHardLinks False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoHardLinksArgument
     */
    public function testNoHardLinksFalse()
    {
        $this->argument->noHardLinks()->noHardLinks();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noHardLinks'));
    }


    /**
     * Test the getVerbose method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoHardLinksArgument
     */
    public function testGetNoHardLinks()
    {
        $expected = ' --no-hardlinks';
        $result = $this->argument->noHardLinks()->getNoHardLinks();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getNoHardLinks method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoHardLinksArgument
     */
    public function testGetNoHardLinksReturnsEmptyString()
    {
        $result = $this->argument->getNoHardLinks();
        $this->assertEmpty($result);
    }

}
