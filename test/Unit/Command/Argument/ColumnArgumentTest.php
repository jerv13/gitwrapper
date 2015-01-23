<?php
/**
 * Test for the Column argument
 *
 * This file contains test for the Column argument
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
 * Test for the Column argument
 *
 * Test for the Column argument
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

class ColumnArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\ColumnArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ColumnArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ColumnArgument', class_uses($this->argument)));
    }

    /**
     * Test Column
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ColumnArgument
     */
    public function testColumn()
    {
        $options = array(
            'AlWays',
            'Column',
            'Dense'
        );

        $this->argument->column($options);
        $this->assertEquals(
            'always,column,dense',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'column')
        );
    }

    /**
     * Test Column Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ColumnArgument
     */
    public function testColumnEmpty()
    {
        $this->argument->column(array());
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'column'));
    }

    /**
     * Test Column Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ColumnArgument
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testColumnInvalid()
    {
        $this->argument->column(array('invalid'));
    }

    /**
     * Test Column Only Accepts Array
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ColumnArgument
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testColumnOnlyAcceptsArray()
    {
        $this->argument->column('invalid');
    }

    /*
     *  NoColumn Property
     */

    /**
     * Test NoColumn
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ColumnArgument
     */
    public function testNoColumn()
    {
        $this->argument->noColumn();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noColumn'));
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'column'));
    }

    /**
     * Test NoColumn False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ColumnArgument
     */
    public function testNoColumnFalse()
    {
        $this->argument->noColumn()->noColumn();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noColumn'));
    }

    /**
     * Test the getColumn method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ColumnArgument
     */
    public function testGetColumn()
    {
        $options = array(
            'AlWays',
            'Column',
            'Dense'
        );

        $expected = ' --column=\'always,column,dense\'';
        $result = $this->argument->column($options)->getColumn();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getColumn method with noColumn set
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ColumnArgument
     */
    public function testGetColumnWithNoColumnSet()
    {
        $expected = ' --no-column';
        $result = $this->argument->noColumn()->getColumn();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getColumn method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ColumnArgument
     */
    public function testGetColumnReturnsEmptyString()
    {
        $result = $this->argument->getColumn();
        $this->assertEmpty($result);
    }
}
