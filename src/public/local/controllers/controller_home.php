<?php if ( ! defined('DOC_ROOT')) { header('HTTP/1.1 403 Forbidden'); die('Permission Denied'); }

class controller_home Extends controller
{
    private $Error;
    private $db;
    private $CSS;
    private $JS;

    function __construct($Error, $db, $CSS, $JS)
    {
        parent::__construct($Error, $db, $CSS, $JS);
        $this->Error    = $Error;
        $this->db       = $db;
        $this->CSS      = $CSS;
        $this->JS       = $JS;
    }

    function home($input)
    {
        $this->render('Home', '');
    }
}