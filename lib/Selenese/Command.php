<?php

namespace Selenese\Command;

use Selenese\CommandResult,
    Selenese\Pattern,
    Selenese\Locator,
    Selenese\Exception\NoSuchElement
    ;

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
     * @throws \NoSuchElementWebDriverError
     * @return \WebDriverElement
     */
    protected function getElement(\WebDriverSession $session, $locator) {
        try {
            $locatorObj = new Locator($locator);
            $element = $session->element($locatorObj->type, $locatorObj->argument);
        }
        catch (\NoSuchElementWebDriverError $e) {
            $element = null;
        }
        if ($element === null) {
            throw new NoSuchElement($locator);
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

    /**
     * @see Selenese\CommandResult::__construct()
     */
    protected function commandResult($continue, $success, $message) {
        return new CommandResult($continue, $success, $message);
    }

}
