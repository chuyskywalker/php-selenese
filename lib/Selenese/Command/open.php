<?php

namespace Selenese\Command;

use Selenese\CommandResult;

class open extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $session->open($this->target);
            return new CommandResult(true, 'Opened: '. $this->target);
        }
        catch (\Exception $e) {
            return new CommandResult(false, 'Could not open: "'. $this->target . '". Error: ' . $e->getMessage());
        }
    }
}
