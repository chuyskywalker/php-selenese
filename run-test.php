<?php

// load up reqs
// todo: autoload/psr/etc/etc
require __DIR__ . '/lib/php-webdriver-master/__init__.php';
foreach (glob(__DIR__ . '/lib/Selenese/*php') as $file) {
    require $file;
}
foreach (glob(__DIR__ . '/lib/Selenese/*/*php') as $file) {
    require $file;
}

// start phantom
$cmd = ''. __DIR__ .'/lib/phantomjs-1.9.1-linux-x86_64/bin/phantomjs --webdriver=5555 > phantom.log 2>&1 & echo $!';
$pid = exec($cmd);
echo "Starting phantomjs ($cmd) @ pid $pid\n";
sleep(1); // todo: to ensure that phantomjs is ready -- need a better way to do this.

use Selenese\Test;
use Selenese\Runner;

try {
    // get the test rolling
    $test = new Test();
    $commandList = $test->loadFromSeleneseHtml($argv[1]);
    $runner = new Runner($test, 'http://127.0.0.1:5555');
    $results = $runner->run();
}
catch (\Exception $e) {
    // oops.
    echo 'Test failed: ' . $e->getMessage() . "\n";
}

// clean up the phantom instance
exec("kill -9 $pid");
echo "Killed phantom\n";