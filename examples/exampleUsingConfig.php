<?php
/**
 * Created by PhpStorm.
 * User: balwantkane
 * Date: 08/10/14
 * Time: 3:30 PM
 */

$options = getopt("", array("config::"));

set_include_path(dirname(dirname(__FILE__)));

require_once 'src/whatsprot.class.php';
require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Parser;

set_time_limit(10);

$yaml   = new Parser();
$config = $yaml->parse(file_get_contents($options["config"]));

########## DO NOT COMMIT THIS FILE WITH YOUR CREDENTIALS ###########
///////////////////////CONFIGURATION///////////////////////
//////////////////////////////////////////////////////////
$username = $config["phone_number"];    // Telephone number including the country code without '+' or '00'.
$password = $config["wh_password"];     // A server generated Password you received from WhatsApp. This can NOT be manually created
$identity = $config["wh_identity"];     // Obtained during registration with this API or using MissVenom (https://github.com/shirioko/MissVenom) to sniff from your phone.
$nickname = $config["wh_nickname"];     // This is the username (or nickname) displayed by WhatsApp clients.
$target   = $config["test_target"];     // Destination telephone number including the country code without '+' or '00'.
$debug    = true;                       // Set this to true, to see debug mode.
///////////////////////////////////////////////////////////


//Change to your time zone fromthe config file
if (isset($config["app_time_zone"])) {
    date_default_timezone_set($config["app_time_zone"]);
}

echo print_r($config);

// php examples/exampleUsingConfig.php --config='examples/sample_config.yaml'
// php examples/exampleUsingConfig.php --config='configs/test_config.yaml'

echo "[] Logging in as '$nickname' ($username)\n";
//Create the whatsapp object and setup a connection.
$w = new WhatsProt($username, $identity, $nickname, $debug, $config);
$w->connect();

// Now loginWithPassword function sends Nickname and (Available) Presence
$w->loginWithPassword($password);
$w->sendMessage($target, "Guess the number :)");

