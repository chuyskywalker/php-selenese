<?php

namespace Selenese\Command;

// assertTextNotPresent(pattern)
class assertTextNotPresent extends Command {
    public function runWebDriver(\WebDriver $session)
    {
        $bodyValue = $session->getPageSource();
        return $this->assertNot($bodyValue, $this->arg1);
    }
}
