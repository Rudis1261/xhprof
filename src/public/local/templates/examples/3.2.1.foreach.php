<?php
function foreachGuarded() {
    $cars = Cars::all();
    foreach($cars as $cid => $car){
        if (!$car->isLuxury()) {
            continue;
        }
        $message = "";
        $message .= "LUXURY ";
        $message .= "{$car->make}, ";
        $message .= "{$car->model}";
        var_dump($message);
    }
}
foreachGuarded();