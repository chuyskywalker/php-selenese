<?php

namespace Selenese\Command;

// assertNotBodyText(pattern)
class assertNotBodyText extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $html = $this->getElement($session, 'css=body')->attribute('innerHTML');
        return $this->assertNot($html, $this->arg1);
    }
}
