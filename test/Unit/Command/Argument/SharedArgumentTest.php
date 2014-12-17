<?php
/**
 * Test for the Shared argument
 *
 * This file contains test for the Shared argument
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
 * Test for the Shared argument
 *
 * Test for the Shared argument
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

class SharedArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\SharedArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\SharedArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\SharedArgument', class_uses($this->argument)));
    }

    /**
     * Test Shared Parameter with value
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedArgument
     */
    public function testShared()
    {
        $this->argument->shared();
        $this->assertEquals(
            'group',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared')
        );
    }

    /**
     * Test Shared Parameter with value
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedArgument
     */
    public function testSharedWithValue()
    {
        $this->argument->shared('all');
        $this->assertEquals(
            'all',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared')
        );
    }

    /**
     * Test Shared Parameter with 'all' aliases
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedArgument
     */
    public function testSharedWithAliasForAll()
    {
        $this->argument->shared('world');
        $this->assertEquals(
            'all',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared')
        );

        $this->argument->shared('everybody');
        $this->assertEquals(
            'all',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared')
        );
    }

    /**
     * Test Shared Parameter False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedArgument
     */
    public function testSharedFalse()
    {
        $this->argument->shared(false);
        $this->assertEquals(
            'umask',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared')
        );
    }

    /**
     * Test Shared Parameter Null
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedArgument
     */
    public function testSharedNull()
    {
        $this->argument->shared(null);
        $this->assertEquals(
            'group',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared')
        );
    }

    /**
     * Test Shared Parameter True Boolean
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedArgument
     */
    public function testSharedTrue()
    {
        $this->argument->shared(true);
        $this->assertEquals(
            'group',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared')
        );

        $this->argument->shared('true');
        $this->assertEquals(
            'group',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared')
        );
    }

    /**
     * Test Shared Parameter Octal
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedArgument
     */
    public function testSharedOctal()
    {
        $this->argument->shared('664');
        $this->assertEquals(
            '664',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'shared')
        );
    }

    /**
     * Test Shared Parameter Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedArgument
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testSharedInvalid()
    {
        $this->argument->shared('Invalid');
    }
    
    /**
     * Test the getShared method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedArgument
     */
    public function testGetShared()
    {
        $expected = ' --shared=\'all\'';
        $result = $this->argument->shared('all')->getShared();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getShared method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\SharedArgument
     */
    public function testGetSharedReturnsEmptyString()
    {
        $result = $this->argument->getShared();
        $this->assertEmpty($result);
    }

}
