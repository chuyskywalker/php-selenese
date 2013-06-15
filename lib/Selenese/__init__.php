<?php

// suuuper ghetto
// todo: real autoloader, kthnx
foreach (glob(__DIR__ . '/*php') as $file) {
    if (strstr($file, '__init__') !== false) {
        continue;
    }
    require $file;
}
foreach (glob(__DIR__ . '/*/*php') as $file) {
    require $file;
}
foreach (glob(__DIR__ . '/*/*/*php') as $file) {
    require $file;
}