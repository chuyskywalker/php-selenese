<?php

namespace Selenese\Command;

class open extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $session->open($this->arg1);
        $url = $session->url();
        return $this->commandResult(true, true, 'Opened, url now: ' . $url);
    }
}
