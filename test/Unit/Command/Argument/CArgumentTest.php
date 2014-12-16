<?php
/**
 * Test for the C argument
 *
 * This file contains test for the C argument
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
 * Test for the C argument
 *
 * Test for the C argument
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

class CArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\CArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\CArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\CArgument', class_uses($this->argument)));
    }

    /**
     * Test C
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\CArgument
     */
    public function testC()
    {
        $expected = array(
            'color.ui' => false,
            'format.pretty' => 'oneline'
        );

        $this->argument->c($expected);
        $this->assertEquals(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'c')
        );
    }

    /**
     * Test C Empty Array
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\CArgument
     */
    public function testCEmptyArray()
    {
        $expected = array();

        $this->argument->c($expected);
        $this->assertEquals(
            $expected,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'c')
        );
    }

    /**
     * Test C Invalid Parameter
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\CArgument
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testCInvalid()
    {
        $this->argument->c('not-valid');
    }


    /**
     * Test the getC method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\CArgument
     */
    public function testGetC()
    {
        $fakeConfig = array(
            'color.ui' => false,
            'format.pretty' => 'oneline'
        );

        $expected = ' -c \'color.ui\'=\'false\'';
        $expected .= ' -c \'format.pretty\'=\'oneline\'';

        $result = $this->argument->c($fakeConfig)->getC();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getC method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\CArgument
     */
    public function testGetCReturnsEmptyString()
    {
        $result = $this->argument->getC();
        $this->assertEmpty($result);
    }

}
