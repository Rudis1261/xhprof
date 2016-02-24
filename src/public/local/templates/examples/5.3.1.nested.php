<?php
    function foreachPreProcess() {
        $shows = "SELECT * FROM
            `tv`
        ORDER by rand()
        LIMIT 12";

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
        $epData = $db->transform($db->getRows(), 'seriesid');

        foreach($showData as $index => $show) {
            $poster = getPoster($show);
            if (empty($poster)) {
                continue;
            }
            if (!file_exists(TV_DIR . "/{$poster}")) {
                continue;
            }

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