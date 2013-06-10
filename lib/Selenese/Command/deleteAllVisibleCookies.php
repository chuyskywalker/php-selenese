<?php

namespace Selenese\Command;

use Selenese\CommandResult;

class deleteAllVisibleCookies extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $session->deleteAllCookies();
            return new CommandResult(true, true, 'All cookies deleted');
        } catch (\Exception $e) {
            return new CommandResult(false, false, 'Could not delete cookies. Error: ' . $e->getMessage());
        }

    }
}
