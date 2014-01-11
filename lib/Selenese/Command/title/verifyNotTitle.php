<?php

namespace Selenese\Command;

// verifyNotTitle(pattern)
class verifyNotTitle extends Command {
    public function runWebDriver(\WebDriver $session)
    {
        $title = $session->getTitle();
        return $this->verifyNot($title, $this->arg1);
    }
}
