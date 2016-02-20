<?php

function loopingBefore($amount = 5000000) {
    $factor = $amount / 10;
    $range = range(1, $amount);

    // Doing it prior to the for condition
    $count = count($range);
    for ($i = 1; $i < $count; $i++) {
        if ($i % $factor == 0) {
            echo "Running $i<br />";
        }
    }
}
loopingBefore();