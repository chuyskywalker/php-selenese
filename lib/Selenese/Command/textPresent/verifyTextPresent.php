<?php

namespace Selenese\Command;

// verifyTextPresent(pattern)
class verifyTextPresent extends Command {
    public function runWebDriver(\WebDriver $session)
    {
        $bodyValue = $session->getPageSource();
        return $this->verify($bodyValue, $this->arg1);
    }
}
