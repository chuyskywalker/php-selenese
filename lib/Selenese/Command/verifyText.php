<?php

namespace Selenese\Command;

// verifyText(locator,pattern)
class verifyText extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $elementText = $this->getElement($session, $this->arg1)->text();
            return $this->verify($elementText, $this->arg2);
        }
        catch (\Exception $e) {
            return $this->commandResult(false, false, 'Could not verify text presence of "'. $this->arg2 . '. Error: ' . $e->getMessage());
        }

    }
}
