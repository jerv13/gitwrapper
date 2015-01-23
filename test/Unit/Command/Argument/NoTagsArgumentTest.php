<?php
/**
 * Test for the No Tags argument
 *
 * This file contains test for the No Tags argument
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
 * Test for the No Tags argument
 *
 * Test for the No Tags argument
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

class NoTagsArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\NoTagsArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\NoTagsArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\NoTagsArgument', class_uses($this->argument)));
    }

    /*
     *  No Tags Argument
     */

    /**
     * Test Tags
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoTagsArgument
     */
    public function testNoTags()
    {
        $this->argument->noTags();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noTags'));
    }

    /**
     * Test Tags False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoTagsArgument
     */
    public function testNoTagsFalse()
    {
        $this->argument->noTags()->noTags();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noTags'));
    }

    /*
     *  N Alias
     */

    /**
     * Test N Alias
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoTagsArgument
     */
    public function testN()
    {
        $this->argument->n();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noTags'));
    }

    /**
     * Test N Alias False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoTagsArgument
     */
    public function testNFalse()
    {
        $this->argument->n()->n();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noTags'));
    }

    /**
     * Test the getTags method with No Tags set
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoTagsArgument
     */
    public function testGetNoTagsWithNoTagsSet()
    {
        $expected = ' --no-tags';
        $result = $this->argument->notags()->getNoTags();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getTags method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NoTagsArgument
     */
    public function testGetNoTagsReturnsEmptyString()
    {
        $result = $this->argument->getNoTags();
        $this->assertEmpty($result);
    }
}
