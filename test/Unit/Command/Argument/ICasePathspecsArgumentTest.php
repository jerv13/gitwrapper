<?php
/**
 * Test for the ICasePathspecs argument
 *
 * This file contains test for the ICasePathspecs argument
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
 * Test for the ICasePathspecs argument
 *
 * Test for the ICasePathspecs argument
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

class ICasePathspecsArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\ICasePathspecsArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ICasePathspecsArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ICasePathspecsArgument', class_uses($this->argument)));
    }

    /**
     * Test ICasePathspecs
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ICasePathspecsArgument
     */
    public function testICasePathspecs()
    {
        $this->argument->iCasePathspecs();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'iCasePathspecs'));
    }

    /**
     * Test ICasePathspecs False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ICasePathspecsArgument
     */
    public function testICasePathspecsFalse()
    {
        $this->argument->iCasePathspecs()->iCasePathspecs();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'iCasePathspecs'));
    }


    /**
     * Test the getICasePathspecs method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ICasePathspecsArgument
     */
    public function testGetICasePathspecs()
    {
        $expected = ' --icase-pathspecs';
        $result = $this->argument->iCasePathspecs()->getICasePathspecs();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getICasePathspecs method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ICasePathspecsArgument
     */
    public function testGetICasePathspecsReturnsEmptyString()
    {
        $result = $this->argument->getICasePathspecs();
        $this->assertEmpty($result);
    }
}
