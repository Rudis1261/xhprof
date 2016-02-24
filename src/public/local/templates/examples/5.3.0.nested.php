<?php
    function foreachSubselect() {
        $shows = "SELECT * FROM
            `tv`
        ORDER by rand()
        LIMIT 12";

        $episodes = "SELECT
            max(`s`) as s,
            count(`e`) as e
        FROM
            `tv_episode`
        WHERE seriesid=:sid:";

        $db = Database::getDatabase();
        $db->query($shows);

        foreach($db->getRows() as $index => $show) {
            $poster = getPoster($show);
            if (empty($poster)) {
                continue;
            }
            if (!file_exists(TV_DIR . "/{$poster}")) {
                continue;
            }

            $data = $db->query($episodes, [
                'sid' => $show['seriesid']
            ]);
            $row = $db->getRow();

            Template::render('partials/show',[
                'poster' => TV_DIR . "/{$poster}",
                'name' => $show['seriesname'],
                'rating' => $show['rating'],
                's' => $row['s'],
                'e' => $row['e'],
            ]);
        }
    }
    foreachSubselect();