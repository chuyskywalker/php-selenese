<?php

namespace Selenese\Command;

class deleteAllVisibleCookies extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $session->deleteAllCookies();
            return $this->commandResult(true, true, 'All cookies deleted');
        } catch (\Exception $e) {
            return $this->commandResult(false, false, 'Could not delete cookies. Error: ' . $e->getMessage());
        }

    }
}
