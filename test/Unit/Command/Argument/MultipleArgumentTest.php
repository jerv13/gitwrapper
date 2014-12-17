<?php
/**
 * Test for the Multiple argument
 *
 * This file contains test for the Multiple argument
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
 * Test for the Multiple argument
 *
 * Test for the Multiple argument
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

class MultipleArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\MultipleArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\MultipleArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\MultipleArgument', class_uses($this->argument)));
    }

    /**
     * Test Multiple
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MultipleArgument
     */
    public function testMultiple()
    {
        $this->argument->multiple();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'multiple'));
    }

    /**
     * Test Multiple False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MultipleArgument
     */
    public function testMultipleFalse()
    {
        $this->argument->multiple()->multiple();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'multiple'));
    }

    /**
     * Test the getMultiple method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MultipleArgument
     */
    public function testGetMultiple()
    {
        $expected = ' --multiple';
        $result = $this->argument->multiple()->getMultiple();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getMultiple method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MultipleArgument
     */
    public function testGetMultipleReturnsEmptyString()
    {
        $result = $this->argument->getMultiple();
        $this->assertEmpty($result);
    }

}
