<?php
/**
 * Test for the B argument
 *
 * This file contains test for the B argument
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
 * Test for the B argument
 *
 * Test for the B argument
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

class BArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\BArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\BArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\BArgument', class_uses($this->argument)));
    }

    /**
     * Test B
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BArgument
     */
    public function testB()
    {
        $this->argument->b('newBranch');
        $this->assertEquals(
            'newBranch',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'b')
        );
    }

    /**
     * Test B With Reset Branch
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BArgument
     */
    public function testBWithReset()
    {
        $this->argument->b('newBranch', true);
        $this->assertEquals(
            'newBranch',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'b')
        );
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'resetBranch'));
    }


    /**
     * Test B Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BArgument
     */
    public function testBEmpty()
    {
        $this->argument->b('newBranch')->b('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'b'));
    }

    /**
     * Test the getB method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BArgument
     */
    public function testGetB()
    {
        $expected = ' -b \'newBranch\'';
        $result = $this->argument->b('newBranch')->getB();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getB method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BArgument
     */
    public function testGetBWithReset()
    {
        $expected = ' -B \'newBranch\'';
        $result = $this->argument->b('newBranch', true)->getB();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getB method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\BArgument
     */
    public function testGetBReturnsEmptyString()
    {
        $result = $this->argument->getB();
        $this->assertEmpty($result);
    }

}
