<?php

namespace Selenese\Command;

class deleteAllVisibleCookies extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $session->deleteAllCookies();
        return $this->commandResult(true, true, 'All cookies deleted');
    }
}
