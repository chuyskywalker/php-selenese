<?php

namespace Selenese\Command;

// assertTitle(pattern)
class assertTitle extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $title = $session->title();
        return $this->assert($title, $this->arg1);
    }
}
