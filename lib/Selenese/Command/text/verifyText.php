<?php

namespace Selenese\Command;

// verifyText(locator,pattern)
class verifyText extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $elementText = $this->getElement($session, $this->arg1)->text();
        return $this->verify($elementText, $this->arg2);
    }
}
