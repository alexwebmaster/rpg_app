<?php
namespace RpgApp\Classes;

use RpgApp\Classes\Player;
use RpgApp\Classes\Weapon;
use RpgApp\Classes\Dice;

class Game
{
    var $id;
    var $rounds;
    var $winner;
    var $order = array();
    var $players = array();

    public function setup()
    {
        $this->id           = md5(uniqid(rand(), true));
        $this->rounds       = 0;
        $this->winner       = false;

        // add Human
        $human                      = new Player();
        $human->name                = 'Humano';
        $human->life                = 12;
        $human->strength            = 1;
        $human->agility             = 2;
        //add weapon
        $human->weapon              = new Weapon();
        $human->weapon->name        = 'Espada Longa';
        $human->weapon->attack      = 2;
        $human->weapon->defense     = 1;
        $human->weapon->damage      = new Dice(6); //uses 1D6

        // add Orc
        $orc                        = new Player();
        $orc->name                  = 'Orc';
        $orc->life                  = 20;
        $orc->strength              = 2;
        $orc->agility               = 0;

        //add weapon
        $orc->weapon                = new Weapon();
        $orc->weapon->name          = 'Clava de madeira';
        $orc->weapon->attack        = 1;
        $orc->weapon->defense       = 0;
        $orc->weapon->damage        = new Dice(8); //uses 1D8

        $this->players = array(1 => $human, 2=> $orc); //named player 1 and player 2
    }

    public function roll_initiative()
    {
        while ( empty($this->order)) {
            $iniciatives = $this->get_initiatives();

            if ($iniciatives[1] > $iniciatives[2]) $this->order = array(1,2); //end loop

            if ($iniciatives[2] > $iniciatives[1]) $this->order = array(2,1); //end loop

            //Otherwise roll again
        }
        return $this->order;   
    }

    public function get_initiatives()
    {
        $iniciatives = array();

        foreach ($this->players as $key => $player)
        {
            $iniciatives[$key] = $player->initiative();
        }

        return $iniciatives;        
    }
}