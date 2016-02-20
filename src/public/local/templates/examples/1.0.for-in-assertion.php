<?php

function loopingIn($amount = 5000000) {
    $factor = $amount / 10;
    $range = range(1, $amount);

    // The count assertion is done in the for condition
    for($i = 1; $i < count($range); $i++) {
        if ($i % $factor == 0) {
            echo "Running $i<br />";
        }
    }
}
loopingIn();