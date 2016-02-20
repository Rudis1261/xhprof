<?php
    function longWayRound($input = false) {

        // Has to check if it's a string
        if (is_string($input)) {
            return $input;
        }

        // Maybe an array?
        if (is_array($input)) {
            return implode(' ', $input);
        }

        // Nope
        return false; // <<-- On empty
    }

    var_dump(longWayRound());
    var_dump(longWayRound("Hello"));
    var_dump(longWayRound(["Hello", "Casta"]));