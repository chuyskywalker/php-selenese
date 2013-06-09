<?php

namespace Selenese;

class Pattern {

    public $type;
    public $value;

    // todo: convert glob to regex
    // todo: support comma separated lists of values
    public function __construct($pattern) {
        $explode = explode(':', $pattern, 2);
        if (count($explode) == 2) {
            $this->type = $explode[0];
            $this->value = $explode[1];
        }
        else {
            $this->type = 'glob';
            $this->value = $pattern;
        }
    }

    /**
     * @param string $content
     * @return bool
     */
    public function match($content) {
        // todo: switch case by method
        if (stristr($content, $this->value) !== false) {
            return true;
        }
        else {
            return false;
        }
    }

}
