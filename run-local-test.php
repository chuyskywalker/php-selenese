<?php

$abspath = __DIR__ . '/tests';
$testFileFullPath = $abspath . '/' . $argv[1];
$serverUrl = 'file://' . $testFileFullPath;

// load up reqs
require __DIR__ . '/lib/php-webdriver-master/__init__.php';
require __DIR__ . '/lib/Selenese/__init__.php';

// start phantom
$cmd = ''. __DIR__ .'/lib/phantomjs-1.9.1-linux-x86_64/bin/phantomjs --webdriver=5555 > phantom.log 2>&1 & echo $!';
//echo "Starting phantomjs ($cmd)...\n";
$pid = exec($cmd);
//echo "...pid $pid, waiting on readyness...\n";

// ensure it's ready
$startWait = time();
while(1) {
    $fileContents = file('phantom.log');
    $lastline = trim(array_pop($fileContents));
    //echo $lastline . "\n";
    if (strstr($lastline, 'running on port 5555') !== false) {
        break;
    }
    usleep(1000000 / 100); // 1000000 == 1 second; sleep for .01 seconds
    if ($startWait + 5 < time()) {
        echo "ERROR: Unable to determine that phantomjs process was ready after 5 seconds, giving up\n";
        exit(1);
    }
}
//echo "...ready\n";

use Selenese\Test;
use Selenese\Runner;

try {
    // get the test rolling
    $test = new Test();
    $commandList = $test->loadFromSeleneseHtml($testFileFullPath);

    // these test are unique in that we override the locate
    $test->baseUrl = $serverUrl;

    // DO IT
    $runner = new Runner($test, 'http://localhost:5555');
    $results = $runner->run();
}
catch (\Exception $e) {
    // oops.
    echo 'Test failed: ' . $e->getMessage() . "\n";
}

echo "\n";

// clean up the phantom instance
exec("kill -9 $pid");
//echo "Killed phantom\n";