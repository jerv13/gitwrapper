<?php
/**
 * Test for the DryRun argument
 *
 * This file contains test for the DryRun argument
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
 * Test for the DryRun argument
 *
 * Test for the DryRun argument
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

class DryRunArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\DryRunArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\DryRunArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\DryRunArgument', class_uses($this->argument)));
    }

    /**
     * Test DryRun
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DryRunArgument
     */
    public function testDryRun()
    {
        $this->argument->dryRun();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'dryRun'));
    }

    /**
     * Test DryRun False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DryRunArgument
     */
    public function testDryRunFalse()
    {
        $this->argument->dryRun()->dryRun();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'dryRun'));
    }

    /**
     * Test the getDryRun method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DryRunArgument
     */
    public function testGetDryRun()
    {
        $expected = ' --dry-run';
        $result = $this->argument->dryRun()->getDryRun();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getDryRun method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\DryRunArgument
     */
    public function testGetDryRunReturnsEmptyString()
    {
        $result = $this->argument->getDryRun();
        $this->assertEmpty($result);
    }

}
