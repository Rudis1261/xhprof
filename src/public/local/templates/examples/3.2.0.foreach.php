<?php
function foreachNotGuarded() {
    foreach(Cars::all() as $car){
        if ($car->isLuxury()) {
            $message = "LUXURY ";
            $message .= "{$car->get('make')}, ";
            $message .= "{$car->get('model')}";
            var_dump($message);
            if ($car->isModern()) {
                var_dump("Is modern {$car->get('make')}");
            }
        }

    }
}
foreachNotGuarded();