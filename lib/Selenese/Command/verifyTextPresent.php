<?php

namespace Selenese\Command;

// verifyTextPresent(pattern)
class verifyTextPresent extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $bodyValue = $session->source();
            return $this->verify($bodyValue, $this->arg1);
        } catch (\Exception $e) {
            return $this->commandResult(false, false, 'Could not verify text presence of "'. $this->arg1 . '. Error: ' . $e->getMessage());
        }

    }
}
