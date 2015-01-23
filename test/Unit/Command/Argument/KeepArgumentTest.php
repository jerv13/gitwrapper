<?php
/**
 * Test for the Keep argument
 *
 * This file contains test for the Keep argument
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
 * Test for the Keep argument
 *
 * Test for the Keep argument
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

class KeepArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\KeepArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\KeepArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\KeepArgument', class_uses($this->argument)));
    }

    /**
     * Test Keep
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\KeepArgument
     */
    public function testKeep()
    {
        $this->argument->keep();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'keep'));
    }

    /**
     * Test Keep False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\KeepArgument
     */
    public function testKeepFalse()
    {
        $this->argument->keep()->keep();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'keep'));
    }

    /*
     *  l Alias Property
     */

    /**
     * Test K
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\KeepArgument
     */
    public function testK()
    {
        $this->argument->k();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'keep'));
    }

    /**
     * Test K False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\KeepArgument
     */
    public function testKFalse()
    {
        $this->argument->k()->k();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'keep'));
    }


    /**
     * Test the getKeep method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\KeepArgument
     */
    public function testGetKeep()
    {
        $expected = ' --keep';
        $result = $this->argument->keep()->getKeep();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getKeep method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\KeepArgument
     */
    public function testGetKeepReturnsEmptyString()
    {
        $result = $this->argument->getKeep();
        $this->assertEmpty($result);
    }
}
