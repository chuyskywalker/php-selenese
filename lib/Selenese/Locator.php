<?php

namespace Selenese;

class Locator {

    public $type;
    public $argument;

    public function __construct($locator) {
        $explode = explode('=', $locator, 2);
        if (count($explode) == 2) {
            $this->type = $explode[0];
            $this->argument = $explode[1];
        }
        else {
            $this->argument = $locator;
            if (substr($locator, 0, 9) == 'document.') {
                $this->type = 'dom';
            }
            elseif (substr($locator, 0, 2) == '//') {
                $this->type = 'xpath';
            }
            else {
                $this->type = 'identifier';
            }
        }
        // convert from selenese to webdriver
        switch ($this->type) {
            // todo: fix these exceptions if possible/needed
//            case 'identifier':
//            case 'ui':
//            case 'dom':
            case 'css': $this->type = 'css selector'; break;
            case 'id': $this->type = 'id'; break;
            case 'name': $this->type = 'name'; break;
            case 'link': $this->type = 'partial link text'; break;
            case 'xpath': $this->type = 'xpath'; break;
            default: throw new \Exception("Cant currently handle tests with '". $this->type ."' locators, change to another method.");
        }
    }

}
