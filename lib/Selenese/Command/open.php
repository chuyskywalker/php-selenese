<?php

namespace Selenese\Command;

class open extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $session->open($this->arg1);
            $url = $session->url();
            return $this->commandResult(true, true, 'Opened, url now: ' . $url);
        }
        catch (\Exception $e) {
            return $this->commandResult(false, false, 'Could not open: "'. $this->arg1 . '". Error: ' . $e->getMessage());
        }
    }
}
