<?php
/**
 * Test for the WorkTree argument
 *
 * This file contains test for the WorkTree argument
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

use Reliv\GitTest\Unit\UnitBase;

require_once __DIR__ . '/../../UnitBase.php';


/**
 * Test for the WorkTree argument
 *
 * Test for the WorkTree argument
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

class WorkTreeArgumentTest extends UnitBase
{
    /** @var \Reliv\Git\Command\Argument\WorkTreeArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\WorkTreeArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\WorkTreeArgument', class_uses($this->argument)));
        $this->initTempDir();
    }

    /*
     *  workTree Property
     */

    /**
     * Test WorkTree
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\WorkTreeArgument
     */
    public function testWorkTree()
    {
        $config = $this->getConfig();

        $this->argument->workTree($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'workTree')
        );
    }

    /**
     * Test WorkTree Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\WorkTreeArgument
     */
    public function testWorkTreeEmptyString()
    {
        $config = $this->getConfig();

        $this->argument->workTree($config['tempFolder'])->workTree('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'workTree'));
    }

    /**
     * Test WorkTree Invalid Parameter
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\WorkTreeArgument
     * @expectedException \Reliv\Git\Exception\DirectoryNotFoundException
     */
    public function testWorkTreeInvalid()
    {
        $this->argument->workTree('/not-a-folder-for-git');
    }


    /**
     * Test the getWorkTree method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\WorkTreeArgument
     */
    public function testGetWorkTree()
    {
        $config = $this->config;
        $tmpFolder = $config['tempFolder'];

        $expected = ' --work-tree='.escapeshellarg($tmpFolder);
        $result = $this->argument->workTree($tmpFolder)->getWorkTree();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getWorkTree method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\WorkTreeArgument
     */
    public function testGetWorkTreeReturnsEmptyString()
    {
        $result = $this->argument->getWorkTree();
        $this->assertEmpty($result);
    }
}
