<?php
/**
 * Log Analysis
 *
 * @alvaroveliz
 */

$startTime = microtime();

require 'lib/LogParser.class.php';

//$path = 'logs/';
//$log  = str_replace('/' , ':', 'log2013-04-18T04:51:57.380--2013-04-18T04:56:44.868--AOS.xml');
$filename = 'php://stdin';

$parser = new LogParser($filename);
$parser->parse();

$endTime = microtime();

echo $endTime - $startTime."\n";
