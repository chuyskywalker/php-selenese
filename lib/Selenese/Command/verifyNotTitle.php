<?php

namespace Selenese\Command;

use Selenese\CommandResult;

// verifyNotTitle(pattern)
class verifyNotTitle extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $title = $session->title();
            return $this->verifyNot($title, $this->arg1);
        }
        catch (\Exception $e) {
            return new CommandResult(false, false, 'Failed to fetch page title. Error: ' . $e->getMessage());
        }
    }
}
