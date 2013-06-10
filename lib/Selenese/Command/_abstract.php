<?php

namespace Selenese\Command;

use Selenese\CommandResult,
    Selenese\Pattern,
    Selenese\Locator;

abstract class Command {

    public $arg1;
    public $arg2;

    /**
     * @param \WebDriverSession $session
     * @return CommandResult
     */
    abstract public function runWebDriver(\WebDriverSession $session);

    /**
     * Utility function to fetch an element of throw an error
     *
     * @param \WebDriverSession $session
     * @param string $locator
     * @throws \Exception
     * @return \WebDriverElement
     */
    protected function getElement(\WebDriverSession $session, $locator) {
        $locatorObj = new Locator($locator);
        $element = $session->element($locatorObj->type, $locatorObj->argument);
        if ($element === null) {
            throw new \Exception("Could not locate element ($locator) : (" . $locatorObj->type . '=' . $locatorObj->argument . ')');
        }
        return $element;
    }

    // these are all mostly simliar
    protected function assert($valueis, $pattern) {
        $patternobj = new Pattern($pattern);
        $matched = $patternobj->match($valueis);
        return new CommandResult($matched, $matched, $matched ? 'Matched' : 'Did not match');
    }

    protected function assertNot($valueis, $pattern) {
        $patternobj = new Pattern($pattern);
        $matched = $patternobj->match($valueis);
        return new CommandResult(!$matched, !$matched, $matched ? 'Matched and should not have' : 'Correctly did not match');
    }

    protected function verify($valueis, $pattern) {
        $patternobj = new Pattern($pattern);
        $matched = $patternobj->match($valueis);
        return new CommandResult(true, $matched, $matched ? 'Matched' : 'Did not match');
    }

    protected function verifyNot($valueis, $pattern) {
        $patternobj = new Pattern($pattern);
        $matched = $patternobj->match($valueis);
        return new CommandResult(true, !$matched, $matched ? 'Matched and should not have' : 'Correctly did not match');
    }

}
