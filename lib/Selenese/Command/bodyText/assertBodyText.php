<?php

namespace Selenese\Command;

// assertBodyText(pattern)
class assertBodyText extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        $html = $this->getElement($session, 'css=body')->attribute('innerHTML');
        return $this->assert($html, $this->arg1);
    }
}
