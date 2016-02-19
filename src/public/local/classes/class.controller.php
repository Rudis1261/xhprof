<?php if ( ! defined('DOC_ROOT')) exit('No direct script access allowed');

class Controller
{
    public $Error;
    public $db;
    public $CSS;
    public $JS;
    public $template = 'home';

    function __construct($Error , $db, $CSS, $JS)
    {
        $this->Error    = $Error;
        $this->db       = $db;
        $this->JS       = $JS;
        $this->CSS      = $CSS;
    }

    function render($title = "", $body = "", $dataArray = [])
    {
        $msg = $this->Error->alert();
        $dataArray['db'] = $this->db;
        echo Template::loadTemplate('layout', [
            'msg'     => $msg,
            'header'  => Template::loadTemplate('header', $dataArray),
            'navbar'  => Template::loadTemplate('navbar', $dataArray),
            'content' => Template::loadTemplate($this->template, $dataArray),
            'footer'  => Template::loadTemplate('footer', $dataArray),
        ]);
        exit();
    }
}