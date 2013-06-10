<?php

namespace Selenese\Command;

use Selenese\Pattern,
    Selenese\CommandResult;

class verifyTextPresent extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $bodyValue = $session->source();
            $pattern = new Pattern($this->target);
            $matches = $pattern->match($bodyValue);
            if ($matches) {
                $msg = 'Found the string.';
            }
            else {
                $msg = 'Could not find the string';
            }
            return new CommandResult(true, $matches, $msg);
        } catch (\Exception $e) {
            return new CommandResult(false, false, 'Could not verify text presence of "'. $this->target . '. Error: ' . $e->getMessage());
        }

    }
}
