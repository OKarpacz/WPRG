<?php

trait Speed {
    protected $speed = 0;

    public function increaseSpeed($value) {
        $this->speed += $value;
    }

    public function decreaseSpeed($value) {
        $this->speed -= $value;
    }
}

class Car {
    use Speed;
    public function start() {
        $this->speed = 0;
        $this->increaseSpeed(10);
    }

    public function getSpeed() {
        return $this->speed;
    }
}

$car = new Car();
$car->start();
echo "Car speed: " . $car->getSpeed();
?>

