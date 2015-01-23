<?php
/**
 * Test for the Local argument
 *
 * This file contains test for the Local argument
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
 * Test for the Local argument
 *
 * Test for the Local argument
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

class LocalArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\LocalArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\LocalArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\LocalArgument', class_uses($this->argument)));
    }

    /**
     * Test Local
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LocalArgument
     */
    public function testLocal()
    {
        $this->argument->local();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'local'));
    }

    /**
     * Test Local False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LocalArgument
     */
    public function testLocalFalse()
    {
        $this->argument->local()->local();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'local'));
    }

    /*
     *  l Alias Property
     */

    /**
     * Test l
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LocalArgument
     */
    public function testL()
    {
        $this->argument->l();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'local'));
    }

    /**
     * Test L False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LocalArgument
     */
    public function testLFalse()
    {
        $this->argument->l()->l();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'local'));
    }


    /**
     * Test the getLocal method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LocalArgument
     */
    public function testGetLocal()
    {
        $expected = ' --local';
        $result = $this->argument->local()->getLocal();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getLocal method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\LocalArgument
     */
    public function testGetLocalReturnsEmptyString()
    {
        $result = $this->argument->getLocal();
        $this->assertEmpty($result);
    }
}
