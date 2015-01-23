<?php
/**
 * Test for the Detach argument
 *
 * This file contains test for the Detach argument
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
 * Test for the Detach argument
 *
 * Test for the Detach argument
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

class DetachArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\DetachArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\DetachArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\DetachArgument', class_uses($this->argument)));
    }

    /**
     * Test Detach
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DetachArgument
     */
    public function testDetach()
    {
        $this->argument->detach();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'detach'));
    }

    /**
     * Test Detach False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DetachArgument
     */
    public function testDetachFalse()
    {
        $this->argument->detach()->detach();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'detach'));
    }

    /**
     * Test the getDetach method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DetachArgument
     */
    public function testGetDetach()
    {
        $expected = ' --detach';
        $result = $this->argument->detach()->getDetach();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getDetach method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DetachArgument
     */
    public function testGetDetachReturnsEmptyString()
    {
        $result = $this->argument->getDetach();
        $this->assertEmpty($result);
    }
}
