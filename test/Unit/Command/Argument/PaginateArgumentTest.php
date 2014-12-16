<?php
/**
 * Test for the Paginate argument
 *
 * This file contains test for the Paginate argument
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
 * Test for the Paginate argument
 *
 * Test for the Paginate argument
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

class PaginateArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\PaginateArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\PaginateArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\PaginateArgument', class_uses($this->argument)));
    }

    /**
     * Test Paginate
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PaginateArgument
     */
    public function testPaginate()
    {
        $this->argument->paginate();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'paginate'));
    }

    /**
     * Test Paginate False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PaginateArgument
     */
    public function testPaginateFalse()
    {
        $this->argument->paginate()->paginate();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'paginate'));
    }

    /*
     *  NoPager Property
     */

    /**
     * Test NoPager
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PaginateArgument
     */
    public function testNoPager()
    {
        $this->argument->noPager();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noPager'));
    }

    /**
     * Test NoPager False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PaginateArgument
     */
    public function testNoPagerFalse()
    {
        $this->argument->noPager()->noPager();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noPager'));
    }

    /**
     * Test the getPaginate method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PaginateArgument
     */
    public function testGetPaginate()
    {
        $expected = ' --paginate';
        $result = $this->argument->paginate()->getPaginate();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getPaginate method with noPager set
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PaginateArgument
     */
    public function testGetPaginateWithNoPager()
    {
        $expected = ' --no-pager';
        $result = $this->argument->noPager()->getPaginate();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getPaginate method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\PaginateArgument
     */
    public function testGetPaginateReturnsEmptyString()
    {
        $result = $this->argument->getPaginate();
        $this->assertEmpty($result);
    }

}
