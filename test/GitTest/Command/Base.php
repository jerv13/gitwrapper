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

namespace GitTest\Command;

use Git\Command\CommandInterface;

require_once __DIR__.'/../../autoload.php';

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
class Base extends \PHPUnit_Framework_TestCase
{
    protected $command;

    protected $config;

    public function setup()
    {
        $config = $this->getConfig();

        $gitMock = $this->getMockBuilder('\Git\Command\Git')
            ->disableOriginalConstructor()
            ->getMock();

        $gitMock->expects($this->atLeastOnce())
            ->method('getCommand')
            ->will($this->returnValue($config['gitPath']));

        $className = get_class($this);

        $className = str_replace('Test', '', $className);

        $this->command = new $className($gitMock);
    }

    public function getConfig()
    {
        if (empty($this->config)) {
            $this->config = include __DIR__.'/../../config.php';
        }

        return $this->config;
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
