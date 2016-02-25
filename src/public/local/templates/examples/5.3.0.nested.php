<?php
    function foreachSubselect() {
        $shows = "SELECT * FROM
            `tv`
        ORDER by `seriesname` ASC";

        $episodes = "SELECT
            max(`s`) as s,
            count(`e`) as e
        FROM
            `tv_episode`
        WHERE seriesid=:sid:";

        $db = Database::getDatabase();
        $db->query($shows);

        $images = 0;
        foreach($db->getRows() as $show) {
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