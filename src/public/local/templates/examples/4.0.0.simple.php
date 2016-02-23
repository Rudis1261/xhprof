<?php
function databasePusOne() {
    $sql = "SELECT * FROM `subscribers`
    ORDER By `firstname`, `surname` ASC";

    $countrySql = "SELECT `code`
    FROM `country`
    WHERE name = :country:";

    $db = Database::getDatabase();
    $db->query($sql);

    $index = 1;
    foreach($db->getRows() as $row) {
        $db->query($countrySql, $row);
        $code = $db->getValue();
        if (empty($code)) {
            continue;
        }
        $out = "{$index}: ";
        $out .= "{$row['firstname']}";
        $out .= " {$row['surname']}";
        $out .= " ({$code})";
        $out .= " - {$row['country']}";
        var_dump($out);
        $index++;
    }
}

databasePusOne();
