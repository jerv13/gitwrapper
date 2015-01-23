<?php
/**
 * Test for the Tags argument
 *
 * This file contains test for the Tags argument
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
 * Test for the Tags argument
 *
 * Test for the Tags argument
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

class TagsArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\TagsArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\TagsArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\TagsArgument', class_uses($this->argument)));
    }

    /**
     * Test Tags
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TagsArgument
     */
    public function testTags()
    {
        $this->argument->Tags();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'tags'));
    }

    /**
     * Test Tags False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TagsArgument
     */
    public function testTagsFalse()
    {
        $this->argument->tags()->tags();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'tags'));
    }

    /*
     *  T Alias Property
     */

    /**
     * Test T
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TagsArgument
     */
    public function testT()
    {
        $this->argument->t();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'tags'));
    }

    /**
     * Test L False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TagsArgument
     */
    public function testTFalse()
    {
        $this->argument->t()->t();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'tags'));
    }

    /**
     * Test the getTags method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TagsArgument
     */
    public function testGetTags()
    {
        $expected = ' --tags';
        $result = $this->argument->tags()->gettags();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getTags method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TagsArgument
     */
    public function testGetTagsReturnsEmptyString()
    {
        $result = $this->argument->getTags();
        $this->assertEmpty($result);
    }
}
