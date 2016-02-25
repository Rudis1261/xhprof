<?php
    function foreachPreProcess() {
        $shows = "SELECT * FROM
            `tv`
        ORDER by `seriesname` ASC";

        $episodes = "SELECT
            seriesid,
            max(`s`) as s,
            count(`e`) as e
        FROM
            `tv_episode`
        GROUP By `seriesid`";

        $db = Database::getDatabase();
        $db->query($shows);
        $showData = $db->getRows();

        $db->query($episodes);
        $ep = $db->getRows();
        $epData = $db->transform($ep, 'seriesid');

        $images = 0;
        foreach($showData as $show) {
            $poster = getPoster($show);
            if (empty($poster)) {
                continue;
            }
            if (!file_exists(TV_DIR . "/{$poster}")) {
                continue;
            }
            if ($images == 120) {
                break;
            } 
            $images++;
            Template::render('partials/show',[
                'poster' => TV_DIR . "/{$poster}",
                'name' => $show['seriesname'],
                'rating' => $show['rating'],
                's' => $epData[$show['seriesid']]['s'],
                'e' => $epData[$show['seriesid']]['e'],
            ]);
        }
    }
    foreachPreProcess();