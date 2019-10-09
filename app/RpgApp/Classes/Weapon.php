<?php
namespace RpgApp\Classes;

use RpgApp\Classes\Dice;

class Weapon
{
    var $name;
    var $attack;
    var $defense;
    var $damage; // use dice

    function __construct()
    {
    	$this->damage = new Dice();
    }

    function cause_damage()
    {
    	return $this->damage->roll(); //Return damage dice roll with no aditional
    }
}