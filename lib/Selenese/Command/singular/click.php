<?php

namespace Selenese\Command;

class clickAndWait extends Command {
    public function runWebDriver(\WebDriver $session)
    {
        $this->getElement($session, $this->arg1)->click();
        return $this->commandResult(true, true, 'Clicked '. $this->arg1);
    }
}
