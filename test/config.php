<?php

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
    'gitPath' => trim(`which git`),
    'tempFolder' => '/tmp/reliv',
    'tempBareRepo' => '/tests/bare', //Relative to temp dir
    'workingClone'   => '/tests/working_clone', //Relative to temp dir
    'outOfDateClone'   => '/tests/out_of_date_clone', //Relative to temp dir
);
