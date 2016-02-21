<?php
    function getHeroesPyramid() {
        $data = DOC_ROOT . '/data/heroes.json';
        if (file_exists($data)) {
            $content = file_get_contents($data);
            if (!empty($content)) {
                $json = json_decode($content, true);
                if (!empty($json)) {
                    return $json;
                }
            }
        }
        return false;
    }

    $heroes = getHeroesPyramid();
    var_dump(array_Keys(current($heroes)));