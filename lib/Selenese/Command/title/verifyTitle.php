<?php

namespace Selenese\Command;

// verifyTitle(pattern)
class verifyTitle extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $title = $session->title();
        return $this->verify($title, $this->arg1);
    }
}
