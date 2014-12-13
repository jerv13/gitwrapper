<?php

/**
 * Tag Command
 *
 * This file contains the Tag Command
 *
 * PHP version 5.3
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

namespace GitTest\Unit\Command;

use Git\Command\CommandInterface;
use GitTest\Base as MainBase;

require_once __DIR__ . '/../../Base.php';

/**
 * Tag Command
 *
 * Tag Command.  Create, list, delete or verify a tag object signed with GPG
 *
 * PHP version 5.3
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
class Base extends MainBase
{
    protected $command;

    protected $config;

    public function setup()
    {
        parent::setup();

        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Git\Command\Git')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->any())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $className = get_class($this);

        $className = str_replace('Test', '', $className);
        $className = str_replace('Unit\\', '', $className);

        $this->command = new $className($gitMock);
    }

    protected function defaultTester(CommandInterface $command, Array $defaults) {
        foreach ($defaults as $prop => $value) {
            $this->assertEquals(
                $value,
                \PHPUnit_Framework_Assert::readAttribute($command, $prop)
            );
        }
    }
}
