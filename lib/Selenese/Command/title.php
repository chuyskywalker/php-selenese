<?php

namespace Selenese\Command;

use Selenese\CommandResult;

class title extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $title = $session->title();
            return new CommandResult(true, 'Got page title: "'. $title . '"');
        }
        catch (\Exception $e) {
            return new CommandResult(false, 'Failed to fetch page title. Error: ' . $e->getMessage());
        }
    }
}
