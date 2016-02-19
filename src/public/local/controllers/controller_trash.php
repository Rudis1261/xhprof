<?php if ( ! defined('DOC_ROOT')) { header('HTTP/1.1 403 Forbidden'); die('Permission Denied'); }

class controller_trash Extends controller
{
    public $Error;
    public $db;
    public $CSS;
    public $JS;

    function __construct($Error, $db, $CSS, $JS)
    {
        parent::__construct($Error, $db, $CSS, $JS);
        $this->Error    = $Error;
        $this->db       = $db;
        $this->CSS      = $CSS;
        $this->JS       = $JS;
    }

    function trash($input)
    {
        $iter = new RecursiveDirectoryIterator("xhprof/runs", FilesystemIterator::SKIP_DOTS);
        foreach (new RecursiveIteratorIterator($iter) as $item) {
            unlink($item);
        }

        $this->Error->add('info', "Cleared Runs");
        redirect('/');
    }
}