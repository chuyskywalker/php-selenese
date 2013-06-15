<?php

namespace Selenese\Command;

// verifyElementPresent(locator)
class verifyElementPresent extends Command {

    /**
     * @see Command::runWebDriver()
     */
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $this->getElement($session, $this->arg1);
            return $this->commandResult(true, true, 'Found');
        }
        catch (NoSuchElement $e) {
            return $this->commandResult(true, false, 'Not found');
        }
        catch (\Exception $e) {
            return $this->commandResult(false, false, 'Significant error in locating element. Error: ' . $e->getMessage());
        }
    }

}
