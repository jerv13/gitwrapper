<?php
/**
 * Test for the Force argument
 *
 * This file contains test for the Force argument
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
 * Test for the Force argument
 *
 * Test for the Force argument
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

class ForceArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\ForceArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ForceArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ForceArgument', class_uses($this->argument)));
    }

    /**
     * Test Force
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ForceArgument
     */
    public function testForce()
    {
        $this->argument->force();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'force'));
    }

    /**
     * Test Force False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ForceArgument
     */
    public function testForceFalse()
    {
        $this->argument->force()->force();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'force'));
    }

    /*
     *  f Alias Property
     */

    /**
     * Test f
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ForceArgument
     */
    public function testL()
    {
        $this->argument->f();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'force'));
    }

    /**
     * Test F False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ForceArgument
     */
    public function testLFalse()
    {
        $this->argument->f()->f();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'force'));
    }


    /**
     * Test the getForce method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ForceArgument
     */
    public function testGetForce()
    {
        $expected = ' --force';
        $result = $this->argument->force()->getForce();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getForce method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ForceArgument
     */
    public function testGetForceReturnsEmptyString()
    {
        $result = $this->argument->getForce();
        $this->assertEmpty($result);
    }

}
