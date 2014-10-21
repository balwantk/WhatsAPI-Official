<?php
/**
 * Created by PhpStorm.
 * User: balwantk
 * Date: 08/10/14
 * Time: 3:30 PM
 */

set_time_limit(10);
require_once 'src/whatsprot.class.php';

// Get config path as a command line option
$options = getopt("", array("config::"));
$target   = "**contact's phone number**";   // Destination telephone number including the country code without '+' or '00'.

//Create the whatsapp object and setup a connection using the config file.
$w = WhatsProt::constructWithConfig($options['config']);
$w->connect();

// Now loginWithConfiguredPassword function sends Nickname and (Available) Presence
$w->loginWithConfiguredPassword();
$w->sendMessage($target, "Config file works!");

// php examples/exampleUsingConfig.php --config='examples/sample_config.yaml'
