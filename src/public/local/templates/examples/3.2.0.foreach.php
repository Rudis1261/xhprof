<?php
function foreachNotGuarded() {
    $cars = Cars::all();
    foreach($cars as $cid => $car){
        $message = "";
        if ($car->isLuxury()) {
            $message .= "LUXURY ";
            $message .= "{$car->make}, ";
            $message .= "{$car->model}";
            var_dump($message);
        }
        var_dump("=> NOT {$car->make}, {$car->model}");
    }
}
foreachNotGuarded();