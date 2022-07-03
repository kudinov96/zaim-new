<?php

use App\Models\Option;

if (! function_exists("getOptions")) {
    function getOptions() {
        return Option::getAllOptions();
    }
}

if (! function_exists("getOption")) {
    function getOption(string $key) {
        return Option::getOption($key);
    }
}
