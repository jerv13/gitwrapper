<?php
$vfs = \org\bovigo\vfs\vfsStream::setup('vfs');

/**
 * Configuration for Unit tests
 *
 * This file contains the Configuration for Unit tests
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
return array(
    'tempFolder' =>  $vfs->url('vfs/temp'),
    'gitPath' => '/usr/bin/git',
);
