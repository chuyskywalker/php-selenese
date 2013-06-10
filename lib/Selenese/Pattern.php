<?php

namespace Selenese;

class Pattern {

    public $type;
    public $value;

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
     * @throws \Exception
     * @return bool
     */
    public function match($content) {
        switch ($this->type) {
            case 'glob':
                return fnmatch($this->value, $content);
                break;
            case 'regexpi':
                $flags = 'i';
            case 'regexp':
            case 'regex':
                if (!isset($flags)) {
                    $flags = '';
                }
                return (bool) preg_match('/' . $this->value .  '/' . $flags, $content);
                break;
            case 'exact':
                return $content == $this->value;
                break;
            default:
                throw new \Exception("Unsupported pattern matching type: " . $this->type);
                break;
        }
    }

}
