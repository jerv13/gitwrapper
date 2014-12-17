<?php
/**
 * Test for the Namespace argument
 *
 * This file contains test for the Namespace argument
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
 * Test for the Namespace argument
 *
 * Test for the Namespace argument
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

class NamespaceArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\NamespaceArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\NamespaceArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\NamespaceArgument', class_uses($this->argument)));
    }

    /**
     * Test setNamespace
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NamespaceArgument
     */
    public function testSetNamespace()
    {
        $namespace = 'someNameSpace';

        $this->argument->setNamespace($namespace);
        $this->assertEquals(
            $namespace,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'namespace')
        );
    }

    /**
     * Test setNamespace False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NamespaceArgument
     */
    public function testSetNamespaceEmpty()
    {
        $this->argument->setNamespace('someNamespace')->setNamespace(false);
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'namespace'));
    }

    /**
     * Test setNamespace Invalid Parameter
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NamespaceArgument
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testSetNamespaceInvalid()
    {
        $this->argument->setNamespace(array('invalid'));
    }


    /**
     * Test the getNamespace method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NamespaceArgument
     */
    public function testGetNamespace()
    {
        $expected = ' --namespace=\'someNameSpace\'';
        $result = $this->argument->setNamespace('someNameSpace')->getNamespace();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getNamespace method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\NamespaceArgument
     */
    public function testGetNamespaceReturnsEmptyString()
    {
        $result = $this->argument->getNamespace();
        $this->assertEmpty($result);
    }

}
