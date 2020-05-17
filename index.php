<?php

//use Clin\Str;
//
//require_once 'vendor/autoload.php';
//
//var_dump(Str::title("Hello world"));

interface Kind {
    function move();
    function eat(Animal $animal);
    function sleep();
    function analyze();
    function propagate();
}

class Animal implements Kind {

    function move()
    {
        // TODO: Implement move() method.
    }

    function eat(Animal $animal)
    {
        // TODO: Implement eat() method.
    }

    function sleep()
    {
        // TODO: Implement sleep() method.
    }

    function analyze()
    {
        // TODO: Implement analyze() method.
    }

    function propagate()
    {
        // TODO: Implement propagate() method.
    }
}

interface BirdKind extends Kind {
    function fly();
}

interface FishKind extends Kind {
    function swim();
}

interface PredatorKind extends Kind {
    function hunt(Animal $animal);
}

interface DiggingKind extends Kind {
    function dig();
}

interface ChangeColorKind extends Kind {
    function changeColor();
}

interface SpiderKind extends Kind {
    function sneak();
}

trait CanFly {
    function fly() {}
}

trait CanSwim {
    function swim() {}
}

trait CanChangeColor {
    function changeColor() {}
}

trait CanHunt {
    function hunt(Animal $animal) {
        $this->eat($animal);
    }
}

trait  CanDig {
    function dig() {}
}

trait CanSneak {
    function sneak() {}
}

trait Has8Legs {
    function has8Legs() {}
}

trait Has4Legs {
    function has4Legs() {}
}

trait Has2Legs {
    function has2Legs() {}
}

trait HasFins {
    function hasFins() {}
}

trait HasBeak {
    function hasBeak() {}
}

trait HasNose {
    function hasNose() {}
}

class Parrot extends Animal implements BirdKind {
    use Has2Legs, CanFly, HasBeak;

    function fly()
    {
    }
}

class Bear extends Animal implements PredatorKind {
    use Has4Legs, CanHunt, CanSwim, HasNose;

    function hunt(Animal $animal)
    {
        $this->eat($animal);
    }
}

class Mole extends Animal implements  DiggingKind {
    use Has4Legs, CanDig, CanHunt, HasNose;
}

class Spider extends Animal implements SpiderKind {
    use Has8Legs, CanHunt, CanSneak, CanDig;
}

class Сhameleon extends Animal implements ChangeColorKind {
    use Has4Legs, HasNose, CanChangeColor, CanSneak, CanHunt;
}

class Penguin extends Animal implements FishKind {
    use Has2Legs, HasFins, CanSwim, CanHunt;
}

