<?php

namespace Selenese\Command;

class title extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $title = $session->title();
            return $this->commandResult(true, true, 'Got page title: "'. $title . '"');
        }
        catch (\Exception $e) {
            return $this->commandResult(false, false, 'Failed to fetch page title. Error: ' . $e->getMessage());
        }
    }
}
