<?php


// an attempt to use the XML core file to discerne valid commands.
// in the end, the fact that it requires "magic guessing" at where asserts/etc lie
// plus the fact that not all asserts lead to a locate+pattern map, and there's no clear way to know,
// I eneded up not using this.
libxml_use_internal_errors(true);
$dom = new \DOMDocument;
$loaded = $dom->loadXML(file_get_contents('http://selenium.googlecode.com/svn/trunk/ide/main/src/content/selenium-core/iedoc-core.xml'));


$xpath = new DOMXPath($dom);
$entries = $xpath->query('function');

$allCommands = array();

foreach ($entries as $entry) { /** @var DOMNode $entry */

    $cmd = $entry->getAttribute('name');
    $comment = str_replace(array('<comment>', '</comment>'), '', $dom->saveXML($xpath->query('comment', $entry)->item(0)));
    $paramList = array();
    foreach ($xpath->query('param', $entry) as $param) {
        $paramList[] = $param->getAttribute('name');
    }

    $variants = array();
    if (preg_match('/^(assert|get)([A-Z].*)/', $cmd, $m)) {
        foreach (array('assert', 'verify') as $prefix) {
            $variants[] = $prefix . $m[2];
            $variants[] = $prefix . 'Not' . $m[2];
        }
    }
    elseif (preg_match('/^is([A-Z].*?)(Present)?$/', $cmd, $m)) {
        foreach (array('assert', 'verify') as $prefix) {
            if (isset($m[2])) {
                $variants[] = $prefix . $m[1] . $m[2];
                $variants[] = $prefix . $m[1] . 'Not' . $m[2];
            }
            else {
                $variants[] = $prefix . $m[1];
                $variants[] = $prefix . 'Not' . $m[1];
            }
        }
    }
    else {
        $allCommands[] = array($cmd, $paramList, $comment);
    }

    $allCommands[] = array(
        'command'    => $cmd,
        'variants'   => $variants,
        'parameters' => $paramList,
        'comment'    => $comment,
    );

}

$template = '<?php

namespace Selenese\Command;

use Selenese\CommandResult;

// {fullcmd}
class {cmd} extends Command {

    /**
     * @see Command::runWebDriver()
     */
    public function runWebDriver(\WebDriverSession $session)
    {
        return new CommandResult(true, false, \'This command "{cmd}" is currently unsupported.\');
    }

}
';




foreach ($allcommands as $cmd) {
    list($command, $variants, $parameters, $comment);

    $filepath = __DIR__ . '/../lib/Selenese/Command/stubs/' . $command . '.php';
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
