<?php

namespace Selenese\Command;

// verifyNotText(locator,pattern)
class verifyNotText extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $elementText = $this->getElement($session, $this->arg1)->text();
            return $this->verifyNot($elementText, $this->arg2);
        }
        catch (\Exception $e) {
            return $this->commandResult(false, false, 'Error: ' . $e->getMessage());
        }
    }
}