<?php
class Car {
    public $make;
    public $model;
    public $year;
    public $luxury;
    function setMake($make) {
        $this->make = $make;
        return $this;
    }
    function setModel($model) {
        $this->model = $model;
        return $this;
    }
    function setYear($year) {
        $this->year = $year;
        return $this;
    }
    function setLuxury($luxury) {
        $this->luxury = $luxury;
        return $this;
    }
    function isLuxury() {
        return $this->luxury;
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

// Some Cars
Cars::addCar( (new Car())->setMake('Opel')->setModel('Astra')->setYear(2012)->setLuxury(false) );
Cars::addCar( (new Car())->setMake('Opel')->setModel('Corsa Turbo')->setYear(2013)->setLuxury(true) );
Cars::addCar( (new Car())->setMake('Mazda')->setModel('3 MPS')->setYear(2014)->setLuxury(true) );
Cars::addCar( (new Car())->setMake('Subaru')->setModel('Impreza STI')->setYear(2004)->setLuxury(true) );
Cars::addCar( (new Car())->setMake('Toyota')->setModel('Hilux 4X4')->setYear(1996)->setLuxury(false) );
Cars::addCar( (new Car())->setMake('Honda')->setModel('Civic')->setYear(2010)->setLuxury(false) );
Cars::addCar( (new Car())->setMake('Mercedes')->setModel('AMG 65')->setYear(2013)->setLuxury(true) );
Cars::addCar( (new Car())->setMake('Ferrari')->setModel('F40')->setYear(1984)->setLuxury(true) );
Cars::addCar( (new Car())->setMake('Porsche')->setModel('911 Turbo GT3')->setYear(2015)->setLuxury(true) );
Cars::addCar( (new Car())->setMake('Porsche')->setModel('911 Turbo GT2')->setYear(2012)->setLuxury(true) );
Cars::addCar( (new Car())->setMake('Porsche')->setModel('911 Turbo GTR')->setYear(2013)->setLuxury(true) );