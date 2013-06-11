<?php

// run all the tests loading themselves for the test. kinda neat.
// run just a subset like: php run-tests.php text/elementPresent

$baseScan = isset($argv[1]) ? $argv[1] : __DIR__ . '/tests/';

$tests = array();
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($baseScan)) as $path => $row) {
    /** @var SplFileInfo $row  */
    if (!preg_match('/^.+\.html$/i', $row->getRealPath())) {
        continue;
    }
    $tests[] = str_replace(__DIR__ . '/tests/', '', $row->getRealPath());
}

sort($tests);

foreach ($tests as $test) {
    $cmd = 'php ' . __DIR__ . "/run-local-test.php " . escapeshellarg($test);
    echo "Test: $cmd\n";
    passthru($cmd);
}
