<?php
    function printNames($index) {
        $heroes = getHeroes();
        if (!empty($heroes[$index]['name'])) {
            return $heroes[$index]['name'];
        }
        return false;
    }
    /**
     * In a loop, sometimes it's easy to miss
     * a more complex call
     */
    foreach(range(0, 47) as $index) {
        var_dump(printNames($index));
    }