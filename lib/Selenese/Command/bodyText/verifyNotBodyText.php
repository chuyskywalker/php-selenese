<?php

namespace Selenese\Command;

// verifyNotBodyText(pattern)
class verifyNotBodyText extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $html = $this->getElement($session, 'css=body')->attribute('innerHTML');
        return $this->verifyNot($html, $this->arg1);
    }
}
