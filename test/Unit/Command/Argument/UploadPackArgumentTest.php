<?php
/**
 * Test for the UploadPack argument
 *
 * This file contains test for the UploadPack argument
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
 * Test for the UploadPack argument
 *
 * Test for the UploadPack argument
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

class UploadPackArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\UploadPackArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\UploadPackArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\UploadPackArgument', class_uses($this->argument)));
    }

    /**
     * Test UploadPack
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UploadPackArgument
     */
    public function testUploadPack()
    {
        $path = '/some/strange/path';

        $this->argument->uploadPack($path);
        $this->assertEquals(
            $path,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'uploadPack')
        );
    }

    /**
     * Test UploadPack Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UploadPackArgument
     */
    public function testUploadPackEmpty()
    {
        $path = '/some/strange/path';
        $this->argument->uploadPack($path)->uploadPack('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'uploadPack'));
    }

    /*
     *  U Alias Property
     */

    /**
     * Test U alias
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UploadPackArgument
     */
    public function testU()
    {
        $path = '/some/strange/path';

        $this->argument->u($path);
        $this->assertEquals(
            $path,
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'uploadPack')
        );
    }

    /**
     * Test U alias Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UploadPackArgument
     */
    public function testUEmpty()
    {
        $path = '/some/strange/path';
        $this->argument->u($path)->u('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'uploadPack'));
    }
    
    /**
     * Test the getUploadPack method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UploadPackArgument
     */
    public function testGetUploadPack()
    {
        $path = '/some/strange/path';

        $expected = ' --upload-pack=\'/some/strange/path\'';
        $result = $this->argument->uploadPack($path)->getUploadPack();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getUploadPack method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\UploadPackArgument
     */
    public function testGetUploadPackReturnsEmptyString()
    {
        $result = $this->argument->getUploadPack();
        $this->assertEmpty($result);
    }
}
