<?php

namespace Selenese\Command;

// assertTextNotPresent(pattern)
class assertTextNotPresent extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $bodyValue = $session->source();
        return $this->assertNot($bodyValue, $this->arg1);
    }
}
