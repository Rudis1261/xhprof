<?php if ( ! defined('DOC_ROOT')) exit('No direct script access allowed');

class Controller
{
    private $Error;
    private $db;
    private $CSS;
    private $JS;
    private $template = 'home';

    function __construct($Error , $db, $CSS, $JS)
    {
        $this->Error    = $Error;
        $this->db       = $db;
        $this->JS       = $JS;
        $this->CSS      = $CSS;
    }

    function render($title = "", $body = "", $dataArray = [])
    {
        echo Template::loadTemplate('layout', [
            'header'  => Template::loadTemplate('header', $dataArray),
            'navbar'  => Template::loadTemplate('navbar', $dataArray),
            'content' => Template::loadTemplate($this->template, $dataArray),
            'footer'  => Template::loadTemplate('footer', [
                $dataArray, 'db' => $this->db
            ])
        ]);
        exit();
    }
}