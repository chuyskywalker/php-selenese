<?php

namespace Selenese\Command;

use Selenese\CommandResult;

class clickAndWait extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $this->getElement($session, $this->arg1)->click();
            return new CommandResult(true, true, 'Clicked '. $this->arg1);
        }
        catch (\Exception $e) {
            return new CommandResult(false, false, 'Could not click on "'. $this->arg1 . '". Error: ' . $e->getMessage());
        }
    }
}
