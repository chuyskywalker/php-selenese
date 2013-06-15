<?php

namespace Selenese\Command;

// assertText(locator,pattern)
class assertText extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $elementText = $this->getElement($session, $this->arg1)->text();
        return $this->assert($elementText, $this->arg2);
    }
}
