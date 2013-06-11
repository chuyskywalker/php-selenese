<?php

namespace Selenese\Command;

use Selenese\CommandResult,
    Selenese\Exception\NoSuchElement;

// assertElementPresent(locator)
class assertElementPresent extends Command {

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
            return new CommandResult(false, false, 'Not found');
        }
        catch (\Exception $e) {
            return new CommandResult(false, false, 'Significant error in locating element. Error: ' . $e->getMessage());
        }
    }

}
