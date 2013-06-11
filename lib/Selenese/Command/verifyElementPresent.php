<?php

namespace Selenese\Command;

use Selenese\CommandResult,
    Selenese\Exception\NoSuchElement;

// verifyElementPresent(locator)
class verifyElementPresent extends Command {

    /**
     * @see Command::runWebDriver()
     */
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $this->getElement($session, $this->arg1);
            return new CommandResult(true, true, 'Found');
        }
        catch (NoSuchElement $e) {
            return new CommandResult(true, false, 'Not found');
        }
        catch (\Exception $e) {
            return new CommandResult(false, false, 'Significant error in locating element. Error: ' . $e->getMessage());
        }
    }

}
