<?php

namespace Selenese\Command;

// assertTitle(pattern)
class assertTitle extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $title = $session->title();
            return $this->assert($title, $this->arg1);
        }
        catch (\Exception $e) {
            return $this->commandResult(false, false, 'Failed to fetch page title. Error: ' . $e->getMessage());
        }
    }
}
