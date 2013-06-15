<?php

namespace Selenese\Command;

// assertNotTitle(pattern)
class assertNotTitle extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $title = $session->title();
        return $this->assertNot($title, $this->arg1);
    }
}
