<?php
/**
 * Log Analysis
 *
 * @alvaroveliz
 */

require 'lib/LogParser.class.php';

$path = 'logs/';
$log  = 'log2013-04-17T23:51:22.735--2013-04-17T23:57:27.505--AOS.xml';
$filename = $path . $log;

$parser = new LogParser($filename);
$parser->parse();
