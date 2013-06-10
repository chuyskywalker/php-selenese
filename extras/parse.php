<?php

$content = file_get_contents('./commands.txt');
$content = str_replace(array(' ', "\t"), '', $content);
//print_r($content);

preg_match_all('/[a-zA-Z]+\(\)/U', $content, $matches1);
preg_match_all('/[a-zA-Z]+\([a-zA-Z]+\)/U', $content, $matches2);
preg_match_all('/[a-zA-Z]+\([a-zA-Z]+,[a-zA-Z]+\)/U', $content, $matches3);

$allcommands = array_merge(
    $matches1[0],
    $matches2[0],
    $matches3[0]
);
$allcommands = array_unique($allcommands);
//sort($allcommands);

$fileContent = '<?php

namespace Selenese\Command;

// {fullcmd}
class {cmd} extends unknown {
    public $command = "{cmd}";
}
';


foreach ($allcommands as $idx => $cmd) {
    if (preg_match('/^waitFor/', $cmd)
        || preg_match('/^store/', $cmd)
        || preg_match('/andWait$/', $cmd)) {
        // this library won't support these commands
        continue;
    }
    $commandName = explode('(', $cmd)[0];
    $filepath = __DIR__ . '/../lib/Selenese/Command/' . $commandName . '.php';
    if (!file_exists($filepath)) {
        echo "Created $filepath \n";
        $intofile = str_replace(array('{fullcmd}', '{cmd}'), array($cmd, $commandName), $fileContent);
        //echo $intofile . "\n\n";
        file_put_contents($filepath, $intofile);

    }
    else {
        echo " exists $filepath \n";
    }
}
//
//sort($allcommands);
//print_r($allcommands);


//$commandList = array();
//
//$prefixes = array('verifyNot', 'verify', 'assertNot', 'assert', 'store', 'waitForNot', 'waitFor', 'verifyNot', 'verify');
//foreach ($allcommands as $command) {
//    $commandName = explode('(', $command)[0];
//    foreach ($prefixes as $prefix) {
//        $pre = substr($commandName, 0, strlen($prefix));
//        var_dump($commandName . ' : ' . $pre . ' - ' . $prefix);
//        if ($pre == $prefix) {
//            $shortCommandName = substr($commandName, strlen($prefix)); // shorten it!
//            var_dump('shorter: ' . $shortCommandName);
//            if (isset($commandList[$shortCommandName])) {
//                $commandList[$shortCommandName]['subcommands'][] = $command;
//                sort($commandList[$shortCommandName]['subcommands']);
//            }
//            else {
//                $commandList[$shortCommandName] = array('command'=>$shortCommandName,'subcommands'=>array($command));
//            }
//            continue 2;
//        }
//    }
//    // didn't have a subcommanding prefix
//    $commandList[$commandName] = array('command'=>$commandName,'subcommands'=>array($command));
//}
//
//print_r($commandList);

//
//libxml_use_internal_errors(true);
//$dom = new \DOMDocument;
//$loaded = $dom->loadHTML(file_get_contents('http://release.seleniumhq.org/selenium-core/1.0.1/reference.html'));
//if (!$loaded) {
//    foreach (libxml_get_errors() as $error) {
//        print_r($error);
//    }
//    libxml_clear_errors();
//}
//
//$rows = $dom->getElementsByTagName('dt');
//
//// extract the commands
//foreach ($rows as $row) {
//    /** @var \DOMElement $row */
//    $code = $row->getElementsByTagName('strong')->item(0);
//    if ($code) {
//        $code = $code->nodeValue;
//    }
//    else {
//        $code = '';
//    }
//    print_r($code);
//}

