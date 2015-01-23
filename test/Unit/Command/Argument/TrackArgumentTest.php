<?php
/**
 * Test for the Track argument
 *
 * This file contains test for the Track argument
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
 * Test for the Track argument
 *
 * Test for the Track argument
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

class TrackArgumentTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Reliv\Git\Command\Argument\TrackArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\TrackArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\TrackArgument', class_uses($this->argument)));
    }

    /**
     * Test Track
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TrackArgument
     */
    public function testTrack()
    {
        $this->argument->track();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'track'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noTrack'));
    }

    /**
     * Test Track False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TrackArgument
     */
    public function testTrackFalse()
    {
        $this->argument->track()->track();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'track'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noTrack'));
    }

    /*
     *  t Alias Property
     */

    /**
     * Test t
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TrackArgument
     */
    public function testT()
    {
        $this->argument->t();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'track'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noTrack'));
    }

    /**
     * Test T False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TrackArgument
     */
    public function testTFalse()
    {
        $this->argument->t()->t();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'track'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noTrack'));
    }

    /*
     * No Track
     */
    /**
     * Test Track
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TrackArgument
     */
    public function testNoTrack()
    {
        $this->argument->noTrack();
        $this->assertTrue(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noTrack'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'track'));
    }

    /**
     * Test Track False
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TrackArgument
     */
    public function testNoTrackFalse()
    {
        $this->argument->noTrack()->noTrack();
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'noTrack'));
        $this->assertFalse(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'track'));
    }

    /**
     * Test the getTrack method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TrackArgument
     */
    public function testGetTrack()
    {
        $expected = ' --track';
        $result = $this->argument->track()->getTrack();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getTrack method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TrackArgument
     */
    public function testGetTrackWithNoTrack()
    {
        $expected = ' --no-track';
        $result = $this->argument->noTrack()->getTrack();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getTrack method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TrackArgument
     */
    public function testGetTrackReturnsEmptyString()
    {
        $result = $this->argument->getTrack();
        $this->assertEmpty($result);
    }
}
