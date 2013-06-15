<?php

namespace Selenese\Command;

// verifyBodyText(pattern)
class verifyBodyText extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $html = $this->getElement($session, 'css=body')->attribute('innerHTML');
        return $this->verify($html, $this->arg1);
    }
}
