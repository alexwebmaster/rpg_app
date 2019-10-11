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
        $this->order = array();   
        while ( empty($this->order)) {
            $iniciatives = array(
                1 => $this->players[1]->initiative(),
                2 => $this->players[2]->initiative()
            ); 

            if ($iniciatives[1] > $iniciatives[2]) $this->order = array(1,2); //end loop

            if ($iniciatives[2] > $iniciatives[1]) $this->order = array(2,1); //end loop

            //Otherwise roll again
        }
        return $this->order;   
    }

    public function run_turn()
    {
        //Check if we have order for security
        if (empty($this->order))
        {
            $this->roll_initiative();
        }

        $damage = 0;
        //set players
        $atacker    = $this->players[$this->order[0]];
        $defenser   = $this->players[$this->order[1]];

        //first player atack the second
        $attack     = $atacker->attack();
        $defense    = $defenser->defense();

        if ($attack > $defense)
        {
            $damage = $atacker->strength + $atacker->weapon->cause_damage();

            if ($damage) {
                $defenser->life -= $damage;
            }

            if ($defenser->life <= 0) {
                //lets set a winner
                $this->winner = $atacker->name;
            }
        }

        $message = $this->damage_message($damage);

        // change positions
        $this->order = array_reverse($this->order);
        //update turns
        $this->rounds++;

        //reset order in turns of 2
        if($this->rounds % 2 == 0){
            $this->order = array();
            $this->roll_initiative();
        }

        return $message;
    }

    public function damage_message($damage)
    {
        if ($damage) {
           return "O ".$this->players[$this->order[1]]->name .', recebeu '.$damage .' pontos de dano.';
        } 
        else 
        {
           return "O ".$this->players[$this->order[1]]->name .', conseguiu defender o ataque';
        }
    }
}