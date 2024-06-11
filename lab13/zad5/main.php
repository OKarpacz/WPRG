<?php

interface Animal {
    public function makeSound();
    public function eat();
}

class Dog implements Animal {
    public function makeSound() {
        return "Woof!";
    }

    public function eat() {
        return "The dog is eating.";
    }
}
//Test
$dog = new Dog();
echo $dog->makeSound() . PHP_EOL;
echo $dog->eat() . PHP_EOL;

?>
