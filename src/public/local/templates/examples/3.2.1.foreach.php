<?php
function foreachGuarded() {
    foreach(Cars::all() as $car){
        if (!$car->isLuxury()) {
            continue;
        }
        $message = "LUXURY ";
        $message .= "{$car->get('make')}, ";
        $message .= "{$car->get('model')}";
        var_dump($message);
        if (!$car->isModern()) {
            continue;
        }
        var_dump("Is modern {$car->get('make')}");
    }
}
foreachGuarded();