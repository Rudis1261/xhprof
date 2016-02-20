<?php

class Config extends Core_Config
{
    public $oAuthKey;
    public $oAuthSecret;
    public $websocketHost;

    public function __construct()
    {
        $this->productionServers = ['/^localhost$/'];
        $this->stagingServers = [''];
        $this->localServers = [''];

        parent::__construct();
        define('ROUTER_HOME', 'home');
        define('CONTROLLER', 'home');
        $this->authSalt = "To where do you roam, when life gets on and everybody about you dies";
    }

    public function production() { return $this->local(); }
    public function staging() { return $this->local(); }
    public function local() {
        ini_set('display_errors', '1');
        ini_set('error_reporting', -1);
        define('WEB_ROOT',  '');
        define('SITE_URL',  'http://localhost');
        define('ASSETS', SITE_URL . "/assets");
        define('IMG', ASSETS . "/img");

        $this->redisHost       = 'redis';

        $this->dbReadHost      = 'mysql';
        $this->dbWriteHost     = 'mysql';
        $this->dbName          = 'local';
        $this->dbDebug         = false;
        $this->dbReadUsername  = 'root';
        $this->dbWriteUsername = 'root';
        $this->dbReadPassword  = 'root';
        $this->dbWritePassword = 'root';

        $this->dbErrorUrl            = SITE_URL . "/Unavailable";
        $this->dbEmailOnErrorSubject = SITE_URL . " DB UNAVAILABLE!!";
        $this->parseConfig();

        $this->dbOnError       = 'die';
        $this->dbEmailOnError  = false;
    }
}
