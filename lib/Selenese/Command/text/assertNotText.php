<?php

namespace Selenese\Command;

// assertNotText(locator,pattern)
class assertNotText extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $elementText = $this->getElement($session, $this->arg1)->text();
        return $this->assertNot($elementText, $this->arg2);
    }
}