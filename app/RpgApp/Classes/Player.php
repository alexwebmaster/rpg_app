<?php
namespace RpgApp\Classes;

use RpgApp\Classes\Weapon;
use RpgApp\Classes\Dice;

class Player
{
    var $life;
    var $name;
    var $strength;
    var $agility;
    var $weapon; // uses ewapon

    function initiative()
    {
    	$dice = new Dice(20);
    	return ($dice->roll() + $this->agility); 
    }

    function attack()
    {
        $dice = new Dice(20);
        return ($dice->roll() + $this->agility + $this->weapon->attack); 
    }

    function defense()
    {
    	$dice = new Dice(20);
    	return ($dice->roll() + $this->agility + $this->weapon->defense); 
    }
}