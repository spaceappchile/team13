<?php
/**
 * Log Analysis
 *
 * @alvaroveliz
 */

require 'lib/LogParser.class.php';

$path = 'logs/';
$log  = str_replace('/' , ':', 'log2013-04-18T04:51:57.380--2013-04-18T04:56:44.868--AOS.xml');
$filename = $path . $log;

$parser = new LogParser($filename);
$parser->parse();
