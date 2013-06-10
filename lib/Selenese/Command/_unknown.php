<?php

namespace Selenese\Command;

use Selenese\CommandResult;

class unknown extends Command {

    public $command;

    public function runWebDriver(\WebDriverSession $session)
    {
        return new CommandResult(true, false, 'This command ('.$this->command.') is currently unsupported.');
    }

}
