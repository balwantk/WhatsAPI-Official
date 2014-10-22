<?php
/**
 * Created by PhpStorm.
 * User: balwantkane
 * Date: 22/10/14
 * Time: 10:30 AM
 */

echo "####################\n";
echo "#                  #\n";
echo "# WA Register Tool #\n";
echo "#  (Config Based)  #\n";
echo "#                  #\n";
echo "####################\n";

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

echo "\n\nRequesting code.. ";

try
{
    $w->codeRequest(); // Will use configured method or fallback to sms.
}
catch(Exception $e)
{
    echo "\nError: $e";
    exit(0);
}

echo "\n\nEnter the received code: ";
$code = fgets(STDIN);

try
{
    $result = $w->codeRegister(trim($code));
    echo "\nYour password is: ".$result->pw;
}
catch(Exception $e)
{
    echo "\Error: $e";
    exit(0);
}

// php examples/registerToolUsingConfig.php --config='examples/sample_registration_config.yaml'