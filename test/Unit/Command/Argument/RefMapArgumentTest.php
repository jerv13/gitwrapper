<?php
/**
 * Test for the RefMap argument
 *
 * This file contains test for the RefMap argument
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
 * Test for the RefMap argument
 *
 * Test for the RefMap argument
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

class RefMapArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\RefMapArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\RefMapArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\RefMapArgument', class_uses($this->argument)));
    }

    /**
     * Test RefMap
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RefMapArgument
     */
    public function testRefMap()
    {
        $refspec = 'refs/heads/*:refs/remotes/origin/*';
        $this->argument->refMap($refspec);
        $this->assertEquals(
            $refspec,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'refMap')
        );
    }

    /**
     * Test RefMap False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RefMapArgument
     */
    public function testRefMapFalse()
    {
        $refspec = 'refs/heads/*:refs/remotes/origin/*';
        $this->argument->refMap($refspec)->refMap('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'refMap'));
    }

    /**
     * Test the getRefMap method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RefMapArgument
     */
    public function testGetRefMap()
    {
        $refspec = 'refs/heads/*:refs/remotes/origin/*';
        $expected = ' --refmap='.escapeshellarg($refspec);
        $result = $this->argument->refMap($refspec)->getRefMap();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getRefMap method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\RefMapArgument
     */
    public function testGetRefMapReturnsEmptyString()
    {
        $result = $this->argument->getRefMap();
        $this->assertEmpty($result);
    }

}
