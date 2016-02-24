<?php
    // Set and create the image directories
    define('TV_DIR', 'assets/img/tv');
    define('POSTER_DIR', 'assets/img/tv/posters');
    if (!file_exists(TV_DIR)) {
        mkdir(TV_DIR);
    }
    if (!file_exists(POSTER_DIR)) {
        mkdir(POSTER_DIR);
    }

    // A little helper to get the poster image name
    function getPoster($show) {
        if (empty($show['poster'])) {
            return false;
        }

        return str_replace('.jpg', '_thumb.jpg', $show['poster']);
    }