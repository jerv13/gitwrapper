<?php
/**
 * Test for the Mirror argument
 *
 * This file contains test for the Mirror argument
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
 * Test for the Mirror argument
 *
 * Test for the Mirror argument
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

class MirrorArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\MirrorArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\MirrorArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\MirrorArgument', class_uses($this->argument)));
    }

    /**
     * Test Mirror
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MirrorArgument
     */
    public function testMirror()
    {
        $this->argument->mirror();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'mirror'));
    }

    /**
     * Test Mirror False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MirrorArgument
     */
    public function testMirrorFalse()
    {
        $this->argument->mirror()->mirror();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'mirror'));
    }

    /**
     * Test the getMirror method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MirrorArgument
     */
    public function testGetMirror()
    {
        $expected = ' --mirror';
        $result = $this->argument->mirror()->getMirror();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getMirror method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\MirrorArgument
     */
    public function testGetMirrorReturnsEmptyString()
    {
        $result = $this->argument->getMirror();
        $this->assertEmpty($result);
    }

}
