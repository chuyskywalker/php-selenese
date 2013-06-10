<?php

namespace Selenese;

use Selenese\Command\open;

class Runner {

    /** @var Test */
    public $test;

    /** @var string */
    public $hubUrl;

    /**
     * @param Test $test
     * @param string $hubUrl
     */
    public function __construct(Test $test, $hubUrl) {
        $this->test = $test;
        $this->hubUrl = $hubUrl;
    }

    /**
     * Run the test!
     *
     * @return array An array of arrays containing the command and the commandResult
     */
    public function run() {
        $webDriver = new \WebDriver($this->hubUrl);
        $session = $webDriver->session('phantomjs'); // todo: more support here

        // always open the base URL and then clear any cookies we've got around
        // todo: how can we could instruct it to be a truly "fresh" session?
        if ($this->test->commands[0]->target != $this->test->baseUrl.'/') {
            $firstOpen = new open();
            $firstOpen->target = $this->test->baseUrl;
            array_unshift($this->test, $firstOpen);
        }

        $results = array();
        foreach ($this->test->commands as $command) {
            // todo: verbosity option
            echo "Running: | " . str_replace('Selenese\\Command\\', '', get_class($command)) . ' | ' . $command->target. ' | ' . $command->value . ' | ';
            $commandResult = $command->runWebDriver($session);
            // todo: screenshots after each command option
            echo ($commandResult->success ? ' SUCCESS | ' : ' FAILED | ') . $commandResult->message . "\n";
            $results[] = array($command, $commandResult);

            if ($commandResult->continue === false) {
                break;
            }

            // todo: screenshot on fail option
            if ($commandResult->success === false) {
                $imgData = base64_decode($session->screenshot());
                file_put_contents('failed.png', $imgData);
                break;
            }
        }
        $session->close();
        return $results;
    }

}