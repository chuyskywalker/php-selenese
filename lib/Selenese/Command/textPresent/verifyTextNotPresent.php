<?php

namespace Selenese\Command;

// verifyTextNotPresent(pattern)
class verifyTextNotPresent extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $bodyValue = $session->source();
        return $this->verifyNot($bodyValue, $this->arg1);
    }
}
