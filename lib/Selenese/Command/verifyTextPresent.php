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
            // todo: catch errors in locator/typing
            if ($matches) {
                $msg = 'Matched the string "' . $this->target . '"';
            }
            else {
                $msg = 'Could not find the string "' . $this->target . '"';
            }
            return new CommandResult($matches, $msg);
        } catch (\Exception $e) {
            return new CommandResult(false, 'Could not verify text presence of "'. $this->target . '. Error: ' . $e->getMessage());
        }

    }
}
