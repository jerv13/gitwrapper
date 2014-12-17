<?php
/**
 * Test for the Z argument
 *
 * This file contains test for the Z argument
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
 * Test for the Z argument
 *
 * Test for the Z argument
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

class ZArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\ZArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ZArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ZArgument', class_uses($this->argument)));
    }

    /**
     * Test Z
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ZArgument
     */
    public function testZ()
    {
        $this->argument->z();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'z'));
    }

    /**
     * Test Z False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ZArgument
     */
    public function testZFalse()
    {
        $this->argument->z()->z();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'z'));
    }


    /**
     * Test the getZ method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ZArgument
     */
    public function testGetZ()
    {
        $expected = ' -z';
        $result = $this->argument->z()->getZ();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getZ method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ZArgument
     */
    public function testGetZReturnsEmptyString()
    {
        $result = $this->argument->getZ();
        $this->assertEmpty($result);
    }

}
