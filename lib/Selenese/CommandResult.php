<?php

namespace Selenese;

class CommandResult {

    /** @var bool Did the command complete successfully? */
    public $success;

    /** @var string Any associate messages */
    public $message;

    public function __construct($success, $message) {
        if (!is_bool($success)) {
            throw new \InvalidArgumentException("success must be a boolean");
        }
        if (!is_string($message)) {
            throw new \InvalidArgumentException("message must be a boolean");
        }
        $this->success = $success;
        $this->message = $message;
    }

}
