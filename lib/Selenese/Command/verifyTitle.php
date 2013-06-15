<?php

namespace Selenese\Command;

// verifyTitle(pattern)
class verifyTitle extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $title = $session->title();
            return $this->verify($title, $this->arg1);
        }
        catch (\Exception $e) {
            return $this->commandResult(false, false, 'Failed to fetch page title. Error: ' . $e->getMessage());
        }
    }
}
