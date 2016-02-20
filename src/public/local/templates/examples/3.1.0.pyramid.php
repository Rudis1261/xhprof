<?php
    function getHeroes() {
        $data = DOC_ROOT . '/data/heroes.json';
        var_dump($data);
        if (file_exists($data)) {
            var_dump("FILE THERE");
            $content = file_get_contents($data);
            var_dump($content);
            if (!empty($content)) {
                $json = json_decode($content, true);
                if (!empty($json)) {
                    return $json;
                }
            }
        }
        return false;
    }

    var_dump(getHeroes());