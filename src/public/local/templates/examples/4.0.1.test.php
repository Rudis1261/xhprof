<?php
    function printNameFromArray($heroes, $index) {
        if (empty($heroes[$index]['name'])) {
            return false;
        }
        return $heroes[$index]['name'];
    }
    /**
     * More efficiently to eliminate complex actions.
     * Or like this case, initialized before consuming it
     */
    $heroes = getHeroes();
    foreach(range(0, 47) as $index) {
        var_dump(printNameFromArray($heroes, $index));
    }