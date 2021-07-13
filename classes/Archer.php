<?php

class Archer extends Character
{

    public $quiver = 10;
    public $arrow = 20;
    public $concentration = false;

    public function __construct($name) {
        parent::__construct($name);
        $this->damage = 7;
    }

    public function turn($target) {
        if ($this->concentration == true) {
            $status = $this->ultimate($target);
        }
        else if ($this->quiver == 0){
            $status = $this->attack($target);
        }
        else if ($this->quiver > 0) {
            $rand = rand(1, 10);
            if ($rand <= 3 ) {
                $status = $this->concentration();
            }
            else if ($rand > 3) {
                $status = $this->useArrow($target);
            }
            return $status;
        }
        return $status;
    }
    public function attack($target) {
        $target->setHealththPoints($this->damage);
        $status = "$this->name donne un coup de dague à $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }

    public function useArrow($target) {
        $target->setHealthPoints($this->arrow);
        $status = "$this->name tire une flèche sur $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    } 

    public function concentration() {
        $this->concentration  = true;
        $status = "$this->name se concentre pour mieux viser sa cible ! ";
        return $status;
    }

    public function ultimate($target){
        $arrowUltimate = $this->arrow * rand(3, 6) / 2;
        $target->setHealthPoints($arrowUltimate);
        $status = "$this->name tire une flèche dans un point vital sur $target->name ! Il reste $target->healthPoints points de vie à $target->name ! ";
        return $status;
    } 
}