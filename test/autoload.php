<?php
/**
 * Testing auto loader.  Please require this file for all unit tests.
 *
 * This file contains the auto loader for unit tests.  We prefer that unit tests are available to be run independently,
 * or in a group.  The best way we have found to ensure this works is to include the below code at the beginning of your
 * unit test.
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @package   Git
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 * @link      https://github.com/reliv
 */

$autoload = '';


if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    //Get the composer autoloader from vendor folder as a standalone module
    $autoload = __DIR__ . '/../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/../../../autoload.php')) {
    //Get the composer autoloader when you're in the vendor folder
    $autoload = __DIR__ . '/../../../autoload.php';
}

if (empty($autoload)) {
    trigger_error(
        'Please make sure to run composer install before running unit tests',
        E_USER_ERROR
    );
}

require_once $autoload;
