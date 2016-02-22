<?php
class Car {
    public $make;
    public $model;
    public $year;
    public $luxury;
    function set($type, $value) {
        $this->$type = $value;
        return $this;
    }
    function get($type) {
        return $this->$type;
    }
    function getData() {
        return [
            $this->make,
            $this->model,
            $this->year,
        ];
    }
    function isLuxury() {
        return $this->luxury;
    }
    function isModern() {
        return $this->year > 2010;
    }
}

class Cars {
    public static $cars = [];
    public static function addCar(Car $car) {
        self::$cars[] = $car;
    }
    public static function all() {
        return self::$cars;
    }
}