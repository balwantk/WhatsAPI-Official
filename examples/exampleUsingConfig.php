<?php
/**
 * Created by PhpStorm.
 * User: balwantkane
 * Date: 08/10/14
 * Time: 3:30 PM
 */

$options = getopt("", array("config::"));

set_include_path(dirname(dirname(__FILE__)));
require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Parser;

$yaml   = new Parser();
$config = $yaml->parse(file_get_contents($options["config"]));

echo "####################################\n";
echo "#                                  #\n";
echo "#           WA CLI CLIENT          #\n";
echo "#                                  #\n";
echo "####################################\n\n";

//Change to your time zone fromthe config file
if (isset($config["app_time_zone"])) {
    date_default_timezone_set($config["app_time_zone"]);
}

echo print_r($config);

// php examples/exampleUsingConfig.php --config='examples/sample_config.yaml'
// php examples/exampleUsingConfig.php --config='configs/test_config.yaml'


