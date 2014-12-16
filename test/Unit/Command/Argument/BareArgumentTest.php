<?php
/**
 * Test for the Bare argument
 *
 * This file contains test for the Bare argument
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
 * Test for the Bare argument
 *
 * Test for the Bare argument
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

class BareArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\BareArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\BareArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\BareArgument', class_uses($this->argument)));
    }
    
    /**
     * Test Bare
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BareArgument
     */
    public function testBare()
    {
        $this->argument->bare();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'bare'));
    }

    /**
     * Test Bare False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BareArgument
     */
    public function testBareFalse()
    {
        $this->argument->bare()->bare();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'bare'));
    }
    
    /**
     * Test the getBare method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BareArgument
     */
    public function testGetBare()
    {
        $expected = ' --bare';
        $result = $this->argument->bare()->getBare();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getBare method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BareArgument
     */
    public function testGetBareReturnsEmptyString()
    {
        $result = $this->argument->getBare();
        $this->assertEmpty($result);
    }

}
