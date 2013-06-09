<?php

namespace Selenese\Command;

use Selenese\Locator,
    Selenese\CommandResult;

class clickAndWait extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $locator = new Locator($this->target);
        try {
            $session->element($locator->type, $locator->argument)->click();
            return new CommandResult(true, 'Clicked '. $this->target);
        }
        catch (\Exception $e) {
            return new CommandResult(false, 'Could not click on "'. $this->target . '". Error: ' . $e->getMessage());
        }
    }
}
