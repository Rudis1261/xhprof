<?php

/**
 * Author: Rudi Strydom
 * Date: 13 Aug 2015
 *
 * Generic dependency injection class
 * Important Classes
 * - $Database
 * - $Auth
 * - $Error
 **/
class syringe {

    public $Database;
    public $Auth;
    public $Error;
    public $SpfError;

    /**
     * On construct either take the dependencies and assign them.
     * Or fire them up by reference
     **/
    function __construct() {
        $arguments = func_get_args();
        foreach($arguments as $args) {
            $type  = gettype($args);
            $class = get_class($args);

            if ($type == "object" && ! empty($class)) {
                $this->$class = $args;
            }
        }

        if (empty($this->Database)) $this->Database = Database::getDatabase();
        if (empty($this->Auth)) $this->Auth = Auth::getAuth();
    }
}