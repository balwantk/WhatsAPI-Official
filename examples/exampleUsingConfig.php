<?php
/**
 * Created by PhpStorm.
 * User: balwantk
 * Date: 08/10/14
 * Time: 3:30 PM
 */

set_include_path(dirname(dirname(__FILE__)));
set_time_limit(10);
require_once 'src/whatsprot.class.php';
require_once 'vendor/autoload.php';

// Get config path as a command line option
$options = getopt("", array("config::"));

use Symfony\Component\Yaml\Parser;

$yaml     = new Parser();
$config   = $yaml->parse(file_get_contents($options["config"]));
$target   = "**contact's phone number**";   // Destination telephone number including the country code without '+' or '00'.

//Create the whatsapp object and setup a connection using the config file.
$w = WhatsProt::constructWithConfig($config);
$w->connect();

// Now loginWithConfiguredPassword function sends Nickname and (Available) Presence
$w->loginWithConfiguredPassword();
$w->sendMessage($target, "Config file works!");

// php examples/exampleUsingConfig.php --config='examples/sample_full_config.yaml'
