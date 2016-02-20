<?php

    // Everything needs a start
    // This should be included at the very top of your application
    define('START_TIME', microtime(true));

    // Show bytes in mere mortal format
    function bytes2str($size) {
        $unit = ['B','KB','MB','GB','TB','PB'];
        return round(
            $size / pow(
                1024, (
                    $i = floor(
                        log( $size, 1024 )
                    )
                )
            ),
            2
        ) . $unit[$i];
    }

    // My Key metrics, which is printed on the right
    // Called from the footer, once all work is complete
    function performance() {
        $db = Database::getDatabase();
        $data = [
            'EXEC TIME' => round(microtime(true) - START_TIME, 4),
            'MEMORY' => bytes2str(memory_get_peak_usage()),
            'SQL QUERY' => count($db->queries),
        ];

        $out = "";
        foreach($data as $key => $value) {
            $out .= "<div class=\"footer-spacer\">{$key}: </div><b>{$value}</b><br />";
        }
        return $out;
    }