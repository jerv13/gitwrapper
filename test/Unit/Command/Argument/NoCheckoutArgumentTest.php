<?php
/**
 * Test for the NoCheckout argument
 *
 * This file contains test for the NoCheckout argument
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
 * Test for the NoCheckout argument
 *
 * Test for the NoCheckout argument
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

class NoCheckoutArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\NoCheckoutArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\NoCheckoutArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\NoCheckoutArgument', class_uses($this->argument)));
    }

    /**
     * Test NoCheckout
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoCheckoutArgument
     */
    public function testNoCheckout()
    {
        $this->argument->noCheckout();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noCheckout'));
    }

    /**
     * Test NoCheckout False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoCheckoutArgument
     */
    public function testNoCheckoutFalse()
    {
        $this->argument->noCheckout()->noCheckout();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noCheckout'));
    }

    /*
     *  N Alias Property
     */

    /**
     * Test N Alias
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoCheckoutArgument
     */
    public function testN()
    {
        $this->argument->n();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noCheckout'));
    }

    /**
     * Test N Alias False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoCheckoutArgument
     */
    public function testNFalse()
    {
        $this->argument->n()->n();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noCheckout'));
    }


    /**
     * Test the getNoCheckout method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoCheckoutArgument
     */
    public function testGetNoCheckout()
    {
        $expected = ' --no-checkout';
        $result = $this->argument->noCheckout()->getNoCheckout();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getNoCheckout method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoCheckoutArgument
     */
    public function testGetNoCheckoutReturnsEmptyString()
    {
        $result = $this->argument->getNoCheckout();
        $this->assertEmpty($result);
    }
}
