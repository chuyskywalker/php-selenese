<?php

namespace Selenese\Command;

use Selenese\CommandResult,
    Selenese\Locator;

abstract class Command {

    public $target;
    public $value;

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

}
