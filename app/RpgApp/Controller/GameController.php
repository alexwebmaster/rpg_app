<?php
namespace RpgApp\Controller;

use Syph\Controller\BaseController;
use Syph\Http\Response\JsonResponse;
use RpgApp\Classes\Game;

// BACKEND FUNCTIONS

class GameController extends BaseController
{
    var $game;
    var $players = array();

    public function create()
    {
        $this->game         = new Game();

        $this->game->setup();
        //create game and add players

        $initiatives = $this->game->roll_initiative();

        //checking if the structure is ok
        echo '<pre>';
        var_dump($initiatives);
        // var_dump($_SESSION['game']);
        echo '</pre>';
    }


    public function initiative()
    {
        // $initiatives = $this->game->roll_initiative();
    }

    public function attack()
    {
        // attack enemy
    }

    public function state()
    {
        // get game state
    }
}