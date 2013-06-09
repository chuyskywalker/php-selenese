<?php

namespace Selenese\Command;

use Selenese\CommandResult;

abstract class Command {

    public $command;
    public $target;
    public $value;

    /**
     * @param \WebDriverSession $session
     * @return CommandResult
     */
    abstract public function runWebDriver(\WebDriverSession $session);

}
