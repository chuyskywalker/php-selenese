<?php

namespace Selenese\Command;

use Selenese\Pattern,
    Selenese\CommandResult;

class deleteAllVisibleCookies extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $session->deleteAllCookies();
            return new CommandResult(true, 'All cookies deleted');
        } catch (\Exception $e) {
            return new CommandResult(false, 'Could not delete cookies. Error: ' . $e->getMessage());
        }

    }
}
