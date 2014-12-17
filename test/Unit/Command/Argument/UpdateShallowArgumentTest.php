<?php
/**
 * Test for the UpdateShallow argument
 *
 * This file contains test for the UpdateShallow argument
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
 * Test for the UpdateShallow argument
 *
 * Test for the UpdateShallow argument
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

class UpdateShallowArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\UpdateShallowArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\UpdateShallowArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\UpdateShallowArgument', class_uses($this->argument)));
    }

    /**
     * Test UpdateShallow
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UpdateShallowArgument
     */
    public function testUpdateShallow()
    {
        $this->argument->updateShallow();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'updateShallow'));
    }

    /**
     * Test UpdateShallow False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UpdateShallowArgument
     */
    public function testUpdateShallowFalse()
    {
        $this->argument->updateShallow()->updateShallow();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'updateShallow'));
    }

    /**
     * Test the getUpdateShallow method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UpdateShallowArgument
     */
    public function testGetUpdateShallow()
    {
        $expected = ' --update-shallow';
        $result = $this->argument->updateShallow()->getUpdateShallow();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getUpdateShallow method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UpdateShallowArgument
     */
    public function testGetUpdateShallowReturnsEmptyString()
    {
        $result = $this->argument->getUpdateShallow();
        $this->assertEmpty($result);
    }

}
