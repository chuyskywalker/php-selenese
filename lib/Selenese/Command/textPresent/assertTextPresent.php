<?php

namespace Selenese\Command;

// assertTextPresent(pattern)
class assertTextPresent extends Command {
    public function runWebDriver(\WebDriver $session)
    {
        $bodyValue = $session->getPageSource();
        return $this->assert($bodyValue, $this->arg1);
    }
}
