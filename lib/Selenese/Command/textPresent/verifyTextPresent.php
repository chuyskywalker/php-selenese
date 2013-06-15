<?php

namespace Selenese\Command;

// verifyTextPresent(pattern)
class verifyTextPresent extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $bodyValue = $session->source();
        return $this->verify($bodyValue, $this->arg1);
    }
}
