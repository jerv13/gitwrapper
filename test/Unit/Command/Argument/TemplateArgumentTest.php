<?php
/**
 * Test for the Template argument
 *
 * This file contains test for the Template argument
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
 * Test for the Template argument
 *
 * Test for the Template argument
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

class TemplateArgumentTest extends UnitBase
{
    /** @var \Reliv\Git\Command\Argument\TemplateArgument */
    protected $argument;

    /**
     * Setup
     *
     * @return void
     */
    public function setup()
    {
        $this->argument = $this->getObjectForTrait('Reliv\Git\Command\Argument\TemplateArgument');
        $this->assertTrue(in_array('Reliv\Git\Command\Argument\TemplateArgument', class_uses($this->argument)));
        $this->initTempDir();
    }

    /**
     * Test Template
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TemplateArgument
     */
    public function testTemplate()
    {
        $config = $this->getConfig();

        $this->argument->template($config['tempFolder']);
        $this->assertEquals(
            $config['tempFolder'],
            \PHPUnit_Framework_Assert::readAttribute($this->argument, 'template')
        );
    }

    /**
     * Test Template Empty
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TemplateArgument
     */
    public function testTemplateEmptyString()
    {
        $config = $this->getConfig();

        $this->argument->template($config['tempFolder'])->template('');
        $this->assertEmpty(\PHPUnit_Framework_Assert::readAttribute($this->argument, 'template'));
    }

    /**
     * Test Template Invalid Parameter
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TemplateArgument
     * @expectedException \Reliv\Git\Exception\DirectoryNotFoundException
     */
    public function testTemplateInvalid()
    {
        $this->argument->template('/not-a-folder-for-git');
    }


    /**
     * Test the getTemplate method
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TemplateArgument
     */
    public function testGetTemplate()
    {
        $config = $this->getConfig();

        $expected = ' --template='.escapeshellarg($config['tempFolder']);
        $result = $this->argument->template($config['tempFolder'])->getTemplate();
        $this->assertEquals($expected, $result);
    }

    /**
     * Test the getTemplate method returns empty string
     *
     * @return void
     *
     * @covers \Reliv\Git\Command\Argument\TemplateArgument
     */
    public function testGetTemplateReturnsEmptyString()
    {
        $result = $this->argument->getTemplate();
        $this->assertEmpty($result);
    }
}
