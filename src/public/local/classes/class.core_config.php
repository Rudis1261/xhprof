<?php

class Core_Config
{
    protected static $me;

    protected $productionServers = [];
    protected $stagingServers    = [];
    protected $localServers      = [];

    public $authDomain;
    public $authSalt;
    public $location;

    public $dbType = 'mysql';
    public $dbReadHost;
    public $dbWriteHost;
    public $dbName;
    public $dbDebug = false;
    public $dbReadUsername;
    public $dbWriteUsername;
    public $dbReadPassword;

    public $dbWritePassword;
    public $dbOnError;
    public $dbEmailTo;
    public $dbEmailOnError;

    public $redisHost;

    public $useDBSessions;
    public $smtpHost;
    public $smtpPort;
    public $smtpUsername;
    public $smtpPassword;
    public $smtpFrom;
    public $smtpDebug;
    public $smtpAuth;

    protected function __construct()
    {
        $this->everywhere();
        $i_am_here = $this->whereAmI();
        $this->location = $i_am_here;

        switch($i_am_here) {
            case 'production':
                $this->production();
                break;

            case 'staging':
                $this->staging();
                break;

            case 'local':
                $this->local();
                break;

            case 'shell':
                $this->shell();
                break;

            default:
                die('<h1>Where am I?</h1> <p>You need to setup your server names in <code>class.config.php</code></p>
                 <p><code>$_SERVER[\'HTTP_HOST\']</code> reported <code>' . $_SERVER['HTTP_HOST'] . '</code></p>');
        }

        define('ENV', $this->location);
    }


    public static function getConfig()
    {
        if(is_null(self::$me))
            self::$me = new Config();
        return self::$me;
    }


    public static function get($key)
    {
        return self::$me->$key;
    }

    protected function parseConfig()
    {
        $config = CORE_ROOT . "/configuration.ini";
        if (file_exists($config)) {
            foreach((array)parse_ini_file($config) as $k => $v) {
                $this->$k = $v;
            }
        }
    }


    protected function everywhere()
    {
        $this->useDBSessions = false;
        $this->authDomain = (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST']: null;
        $this->authSalt   = 'Get down to it, you got to get down to it.';

        define('PWD', getcwd());
    }


    protected function production()
    {
        ini_set('display_errors', '0');
        ini_set('error_reporting', E_ALL);
        $this->dbErrorUrl            = SITE_URL . "/Unavailable";
        $this->dbEmailOnErrorSubject = SITE_URL . " DB UNAVAILABLE!!";
        $this->parseConfig();
    }


    protected function staging()
    {
        ini_set('display_errors', '1');
        ini_set('error_reporting', -1);
        $this->dbErrorUrl            = SITE_URL . "/Unavailable";
        $this->dbEmailOnErrorSubject = SITE_URL . " DB UNAVAILABLE!!";
        $this->parseConfig();
    }


    protected function local()
    {
        $this->staging();
    }


    protected function shell()
    {
        switch (arguments('env')) {

            case 'local':
            case 'development':
                $this->local();
                break;

            case 'staging':
                $this->staging();
                break;

            default:
                $this->production();
                break;
        }
    }

    public function whereAmI()
    {
        // No host set, then it would be CLI
        if (empty(getenv('HTTP_HOST'))){
            return 'shell';
        }

        for($i = 0; $i < count($this->productionServers); $i++)
            if(preg_match($this->productionServers[$i], getenv('HTTP_HOST')) === 1)
                return 'production';

        for($i = 0; $i < count($this->stagingServers); $i++)
            if(preg_match($this->stagingServers[$i], getenv('HTTP_HOST')) === 1)
                return 'staging';

        for($i = 0; $i < count($this->localServers); $i++)
            if(preg_match($this->localServers[$i], getenv('HTTP_HOST')) === 1)
                return 'local';

        // But we should fall back to CLI as well
        return 'shell';
    }
}
