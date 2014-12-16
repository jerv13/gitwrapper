<?php
/**
 * Test for the Progress argument
 *
 * This file contains test for the Progress argument
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
 * Test for the Progress argument
 *
 * Test for the Progress argument
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

class ProgressArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\ProgressArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ProgressArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ProgressArgument', class_uses($this->argument)));
    }

    /**
     * Test Progress
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ProgressArgument
     */
    public function testProgress()
    {
        $this->argument->progress();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'progress'));
    }

    /**
     * Test Progress False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ProgressArgument
     */
    public function testProgressFalse()
    {
        $this->argument->progress()->progress();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'progress'));
    }


    /**
     * Test the getProgress method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ProgressArgument
     */
    public function testGetProgress()
    {
        $expected = ' --progress';
        $result = $this->argument->progress()->getProgress();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getProgress method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ProgressArgument
     */
    public function testGetProgressReturnsEmptyString()
    {
        $result = $this->argument->getProgress();
        $this->assertEmpty($result);
    }

}
