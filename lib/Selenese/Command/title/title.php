<?php

namespace Selenese\Command;

// title()
class title extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $title = $session->title();
        return $this->commandResult(true, true, 'Got page title: "'. $title . '"');
    }
}
