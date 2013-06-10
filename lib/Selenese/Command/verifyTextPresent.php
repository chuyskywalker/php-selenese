<?php

namespace Selenese\Command;

use Selenese\CommandResult;

// verifyTextPresent(pattern)
class verifyTextPresent extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $bodyValue = $session->source();
            return $this->verify($bodyValue, $this->arg1);
        } catch (\Exception $e) {
            return new CommandResult(false, false, 'Could not verify text presence of "'. $this->arg1 . '. Error: ' . $e->getMessage());
        }

    }
}
