<?php

// run all the tests loading themselves for the test. kinda neat.
foreach (glob(__DIR__ . '/tests/*.html') as $test) {
    $cmd = 'php ' . __DIR__ . "/run-local-test.php " . escapeshellarg("file://$test") . ' ' . escapeshellarg($test);
    echo "Test: $test\n -> $cmd\n";
//    echo $cmd . "\n";
    passthru($cmd);
}
