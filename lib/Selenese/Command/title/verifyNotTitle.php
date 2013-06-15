<?php

namespace Selenese\Command;

// verifyNotTitle(pattern)
class verifyNotTitle extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $title = $session->title();
        return $this->verifyNot($title, $this->arg1);
    }
}
