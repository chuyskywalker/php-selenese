<?php

namespace Selenese\Command;

// assertText(locator,pattern)
class assertText extends Command {
    public function runWebDriver(\WebDriver $session)
    {
        $elementText = $this->getElement($session, $this->arg1)->getText();
        return $this->assert($elementText, $this->arg2);
    }
}
