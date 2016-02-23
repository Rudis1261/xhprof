<?php
function databaseJoined() {
    $sql = "SELECT * FROM `subscribers`
    INNER JOIN `country`
    ON `country`.name = `subscribers`.country
    ORDER By `firstname`, `surname` ASC";

    $db = Database::getDatabase();
    $db->query($sql);

    $index = 1;
    foreach($db->getRows() as $row) {
        $out = "{$index}: ";
        $out .= "{$row['firstname']}";
        $out .= " {$row['surname']}";
        $out .= " ({$row['code']})";
        $out .= " - {$row['country']}";
        var_dump($out);
        $index++;
    }
}

databaseJoined();
