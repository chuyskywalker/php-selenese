<?php

namespace Selenese\Command;

class clickAndWait extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $this->getElement($session, $this->arg1)->click();
            return $this->commandResult(true, true, 'Clicked '. $this->arg1);
        }
        catch (\Exception $e) {
            return $this->commandResult(false, false, 'Could not click on "'. $this->arg1 . '". Error: ' . $e->getMessage());
        }
    }
}
