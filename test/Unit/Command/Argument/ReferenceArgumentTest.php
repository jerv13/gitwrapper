<?php
/**
 * Test for the Reference argument
 *
 * This file contains test for the Reference argument
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
 * Test for the Reference argument
 *
 * Test for the Reference argument
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

class ReferenceArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\ReferenceArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\ReferenceArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\ReferenceArgument', class_uses($this->argument)));
    }

    /**
     * Test Reference
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ReferenceArgument
     */
    public function testReference()
    {
        $repository = '/someFile';

        $this->argument->reference($repository);
        $this->assertEquals(
            $repository,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'reference')
        );
    }

    /**
     * Test Reference False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ReferenceArgument
     */
    public function testReferenceEmpty()
    {
        $repository = '/someFile';
        $this->argument->reference($repository)->reference('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'reference'));
    }


    /**
     * Test the getReference method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ReferenceArgument
     */
    public function testGetReference()
    {
        $expected = ' --reference=\'UnitTest\'';
        $result = $this->argument->reference('UnitTest')->getReference();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getReference method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\ReferenceArgument
     */
    public function testGetReferenceReturnsEmptyString()
    {
        $result = $this->argument->getReference();
        $this->assertEmpty($result);
    }
}
