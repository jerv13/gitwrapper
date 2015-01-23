<?php
/**
 * Test for the UntrackedFiles argument
 *
 * This file contains test for the UntrackedFiles argument
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
 * Test for the UntrackedFiles argument
 *
 * Test for the UntrackedFiles argument
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

class UntrackedFilesArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\UntrackedFilesArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\UntrackedFilesArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\UntrackedFilesArgument', class_uses($this->argument)));
    }

    /**
     * Test UntrackedFiles
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UntrackedFilesArgument
     */
    public function testUntrackedFiles()
    {
        $this->argument->untrackedFiles('NoRmAl');
        $this->assertEquals(
            'normal',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'untrackedFiles')
        );
    }

    /**
     * Test UntrackedFiles Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UntrackedFilesArgument
     */
    public function testUntrackedFilesEmpty()
    {
        $this->argument->untrackedFiles('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'untrackedFiles'));
    }

    /**
     * Test UntrackedFiles Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UntrackedFilesArgument
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testUntrackedFilesInvalid()
    {
        $this->argument->untrackedFiles('invalid');
    }

    /*
     *  U Alias
     */

    /**
     * Test U
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UntrackedFilesArgument
     */
    public function testUFiles()
    {
        $this->argument->u('NoRmAl');
        $this->assertEquals(
            'normal',
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'untrackedFiles')
        );
    }

    /**
     * Test U Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UntrackedFilesArgument
     */
    public function testUFilesEmpty()
    {
        $this->argument->u('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'untrackedFiles'));
    }

    /**
     * Test U Invalid
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UntrackedFilesArgument
     * @expectedException \Reliv\Git\Exception\InvalidArgumentException
     */
    public function testUFilesInvalid()
    {
        $this->argument->untrackedFiles('invalid');
    }


    /**
     * Test the getUntrackedFiles method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UntrackedFilesArgument
     */
    public function testGetUntrackedFiles()
    {
        $expected = ' --untracked-files=\'normal\'';
        $result = $this->argument->UntrackedFiles('normal')->getUntrackedFiles();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getUntrackedFiles method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UntrackedFilesArgument
     */
    public function testGetUntrackedFilesReturnsEmptyString()
    {
        $result = $this->argument->getUntrackedFiles();
        $this->assertEmpty($result);
    }
}
