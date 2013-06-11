<?php

namespace Selenese\Command;

use Selenese\CommandResult,
    Selenese\Exception\NoSuchElement;

// verifyElementNotPresent(locator)
class verifyElementNotPresent extends unknown {

    /**
     * @see Command::runWebDriver()
     */
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $this->getElement($session, $this->arg1);
            return new CommandResult(true, false, 'Found, should not have been');
        }
        catch (NoSuchElement $e) {
            return new CommandResult(true, true, 'Not found, as per-request');
        }
        catch (\Exception $e) {
            return new CommandResult(false, false, 'Significant error in locating element. Error: ' . $e->getMessage());
        }
    }

}