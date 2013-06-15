<?php

namespace Selenese\Command;

// assertTextPresent(pattern)
class assertTextPresent extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $bodyValue = $session->source();
        return $this->assert($bodyValue, $this->arg1);
    }
}
