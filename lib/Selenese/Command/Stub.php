<?php

namespace Selenese\Command;

class Stub extends Command {

    public $command;

    public function runWebDriver(\WebDriverSession $session)
    {
        return $this->commandResult(true, false, 'This command ('.$this->command.') is currently unsupported.');
    }

}
