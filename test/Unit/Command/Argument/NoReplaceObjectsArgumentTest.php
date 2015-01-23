<?php
/**
 * Test for the NoReplaceObjects argument
 *
 * This file contains test for the NoReplaceObjects argument
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
 * Test for the NoReplaceObjects argument
 *
 * Test for the NoReplaceObjects argument
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

class NoReplaceObjectsArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\NoReplaceObjectsArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\NoReplaceObjectsArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\NoReplaceObjectsArgument', class_uses($this->argument)));
    }

    /**
     * Test NoReplaceObjects
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testNoReplaceObjects()
    {
        $this->argument->noReplaceObjects();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noReplaceObjects'));
    }

    /**
     * Test NoReplaceObjects False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\GitCommand
     */
    public function testNoReplaceObjectsFalse()
    {
        $this->argument->noReplaceObjects()->noReplaceObjects();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noReplaceObjects'));
    }


    /**
     * Test the getNoReplaceObjects method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoReplaceObjectsArgument
     */
    public function testGetNoReplaceObjects()
    {
        $expected = ' --no-replace-objects';
        $result = $this->argument->noReplaceObjects()->getNoReplaceObjects();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getNoReplaceObjects method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoReplaceObjectsArgument
     */
    public function testGetNoReplaceObjectsReturnsEmptyString()
    {
        $result = $this->argument->getNoReplaceObjects();
        $this->assertEmpty($result);
    }
}
