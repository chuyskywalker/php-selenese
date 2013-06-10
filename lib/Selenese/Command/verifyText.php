<?php

namespace Selenese\Command;

use Selenese\Pattern,
    Selenese\CommandResult;

class verifyText extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $elementText = $this->getElement($session, $this->target)->text();

            // todo: I get the impression this will be a pattern that repeats a lot and will be moved up to \Command like getElement
            $pattern = new Pattern($this->value);
            $matches = $pattern->match($elementText);
            if ($matches) {
                $msg = 'Matched the string "' . $this->value . '"';
            }
            else {
                $msg = 'Did not match the string "' . $this->value . '", instead found "' . $elementText . '"';
            }
            return new CommandResult(true, $matches, $msg);

        } catch (\Exception $e) {
            return new CommandResult(false, false, 'Could not verify text presence of "'. $this->value . '. Error: ' . $e->getMessage());
        }

    }
}
