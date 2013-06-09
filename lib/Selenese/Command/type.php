<?php

namespace Selenese\Command;

use Selenese\Locator,
    Selenese\CommandResult;

class type extends Command {
    public function runWebDriver(\WebDriverSession $session)
    {
        try {
            $locator = new Locator($this->target);
            $session->element($locator->type, $locator->argument)->value($this->split_keys($this->value));
            return new CommandResult(true, 'Typed "'. $this->value . '" into ' . $this->target);
        }
        catch (\Exception $e) {
            return new CommandResult(false, 'Could not type "'. $this->value . '" into ' . $this->target . '. Error: ' . $e->getMessage());
        }
    }
    private function split_keys($toSend)
    {
        $payload = array("value" => preg_split("//u", $toSend, -1, PREG_SPLIT_NO_EMPTY));
        return $payload;
    }
}
