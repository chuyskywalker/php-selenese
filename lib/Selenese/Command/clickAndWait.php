<?php

namespace Selenese\Command;

use Selenese\CommandResult;

class clickAndWait extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $this->getElement($session, $this->target)->click();
            return new CommandResult(true, true, 'Clicked '. $this->target);
        }
        catch (\Exception $e) {
            return new CommandResult(false, false, 'Could not click on "'. $this->target . '". Error: ' . $e->getMessage());
        }
    }
}
