<?php
/**
 * Test for the Orphan argument
 *
 * This file contains test for the Orphan argument
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
 * Test for the Orphan argument
 *
 * Test for the Orphan argument
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

class OrphanArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\OrphanArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\OrphanArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\OrphanArgument', class_uses($this->argument)));
    }

    /**
     * Test Orphan
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OrphanArgument
     */
    public function testOrphan()
    {
        $branch = 'someBranch';
        $this->argument->orphan($branch);
        $this->assertEquals(
            $branch,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'orphan')
        );
    }

    /**
     * Test Orphan False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OrphanArgument
     */
    public function testOrphanFalse()
    {
        $this->argument->orphan('someBranch')->orphan('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'orphan'));
    }

    /**
     * Test the getOrphan method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OrphanArgument
     */
    public function testGetOrphan()
    {
        $expected = ' --orphan=\'someBranch\'';
        $result = $this->argument->orphan('someBranch')->getOrphan();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getOrphan method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\OrphanArgument
     */
    public function testGetOrphanReturnsEmptyString()
    {
        $result = $this->argument->getOrphan();
        $this->assertEmpty($result);
    }
}
