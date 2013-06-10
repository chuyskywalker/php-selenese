<?php

namespace Selenese\Command;

use Selenese\CommandResult;

class open extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $session->open($this->arg1);
            $url = $session->url();
            return new CommandResult(true, true, 'Opened, url now: ' . $url);
        }
        catch (\Exception $e) {
            return new CommandResult(false, false, 'Could not open: "'. $this->arg1 . '". Error: ' . $e->getMessage());
        }
    }
}
