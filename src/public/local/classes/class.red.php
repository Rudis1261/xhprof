<?php

    /**
     * Redis client abstraction. It's not much, but best to abstract this from the get go
     */
    class Red
    {

        public static $me;
        public $Red;
        public $RedActive = false;
        public $host;
        public $key;

        public function __construct($url=false, $redisHost=false)
        {
            if (empty($url)) {
                $url = parse_url(SITE_URL);
            } else {
                $url = parse_url($url);
            }

            $this->key = $url['host'];

            if (!empty($redisHost)) {
                $this->host = $redisHost;
            } elseif (class_exists('Config')) {
                $this->host = Config::get('redisHost');
            }

            // Strip out dev
            if (strstr($this->key, 'dev.')) {
                $this->key = str_replace('dev.', '', $this->key);
            }

            // Strip out www
            if (strstr($this->key, 'www.')) {
                $this->key = str_replace('www.', '', $this->key);
            }

            // To connect or not to connect that is the question
            if (!class_exists('Redis') || empty($this->host)) {
                $this->RedActive = false;
            } else {
                $this->Red = new Redis();
                $this->RedActive = false;
                try {
                    if ($this->Red->connect($this->host, 6379) !== false) {
                        $this->RedActive = true;
                    }
                } catch (Exception $e) {}
            }
        }


        public static function getRed($url=false, $newInstance=false, $host=false)
        {
            if (is_null(self::$me) || !empty($newInstance)) {
                self::$me = new Red($url, $host);
            }
            return self::$me;
        }


        public static function get($key)
        {
            if (self::$me->RedActive) {

                $get = self::$me->Red->get(self::$me->key.":".$key);
                $JSON = json_decode($get, true);

                if ($get === false) {
                    return false;
                }

                if ($JSON !== false && is_array($JSON)) {
                    return $JSON;
                }

                if (is_string($get)) {
                    return $get;
                }
            }
            return false;
        }


        public static function exists($key)
        {
            if (self::$me->RedActive) {
                return self::$me->Red->exists(self::$me->key.":".$key);
            }
            return false;
        }


        public static function set($key, $value="", $expiry=false)
        {
            if (empty($key)) {
                return false;
            }

            if (is_array($value)) {
                $value = json_encode($value);
            }

            if (self::$me->RedActive) {
                $set = self::$me->Red->set(
                    self::$me->key . ":" . $key,
                    $value
                );

                // We may need an expiry
                if (!empty($expiry) && is_numeric($expiry)) {
                    self::$me->Red->setTimeout(
                        self::$me->key . ":" . $key,
                        $expiry
                    );
                }

                return $set;
            }

            return false;
        }


        public static function del($key)
        {
            if (self::$me->RedActive) {
                $del = self::$me->Red->del(self::$me->key.":".$key );
                return $del;
            }
            return false;
        }


        public static function setRange($key, $value, $limit=false)
        {
            if (self::$me->RedActive) {

                // Insert the new list value
                $set = self::$me->Red->lPush(
                    self::$me->key.":".$key,
                    $value
                );

                // Trim other values off
                if (!empty($limit)) {
                    self::$me->Red->lTrim(
                        self::$me->key.":".$key,
                        0,
                        $limit
                    );
                }
                return $set;
            }
            return false;
        }


        public static function lPush($key, $value)
        {
            if (self::$me->RedActive) {

                // Insert the new list value
                $set = self::$me->Red->lPush(
                    self::$me->key.":".$key,
                    $value
                );
                return $set;
            }
            return false;
        }


        public static function getRange($key, $limit=false)
        {
            if (self::$me->RedActive) {

                // Insert the new list value
                $limit = (empty($limit)) ? -1 : $limit;
                $get = self::$me->Red->lRange(self::$me->key.":".$key , 0, $limit);
                if ($get !== false) {
                    return $get;
                }
            }
            return false;
        }


        public static function increment($key, $value=1)
        {
            if (self::$me->RedActive) {
                $set = self::$me->Red->incrBy(
                    self::$me->key.":".$key,
                    $value
                );
                return $set;
            }
            return false;
        }
    }