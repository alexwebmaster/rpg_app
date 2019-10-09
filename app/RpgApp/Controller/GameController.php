<?php
namespace RpgApp\Controller;

use Syph\Controller\BaseController;
use Syph\Http\Response\JsonResponse;

// BACKEND FUNCTIONS

class GameController extends BaseController
{
    var $game_id;
    var $rounds;
    var $winner;
    var $players = array();

    function __construct()
    {
        parent::__construct();
        $this->game_id      = session_id();
    }

    public function create()
    {
        $this->rounds       = 0;
        $this->winner       = false;
        //create players
    }

    public function initiative()
    {
        // do something
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