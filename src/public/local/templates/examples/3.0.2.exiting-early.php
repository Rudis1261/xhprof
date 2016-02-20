<?php
    function shortWayRound($input = false) {

        // Well it's empty, get the hell outa here
        if (empty($input)) {
            return false; // <<-- On empty
        }

        // Has to check if it's a string
        if (is_string($input)) {
            return $input;
        }

        // Maybe an array?
        if (is_array($input)) {
            return implode(' ', $input);
        }
    }

    var_dump(shortWayRound());
    var_dump(shortWayRound("Hello"));
    var_dump(shortWayRound(["Hello", "Casta"]));