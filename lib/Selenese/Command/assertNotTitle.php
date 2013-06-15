<?php

namespace Selenese\Command;

// assertNotTitle(pattern)
class assertNotTitle extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $title = $session->title();
            return $this->assertNot($title, $this->arg1);
        }
        catch (\Exception $e) {
            return $this->commandResult(false, false, 'Failed to fetch page title. Error: ' . $e->getMessage());
        }
    }
}
