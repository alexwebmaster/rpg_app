<?php
namespace RpgApp\Controller;

use Syph\Controller\BaseController;
use Syph\Http\Response\JsonResponse;
use RpgApp\Classes\Game;

// BACKEND FUNCTIONS

class GameController extends BaseController
{
    var $game;

    public function create()
    {
        $this->game         = new Game();
        $this->game->setup();
        //create game and add players
        $this->save_game();

        return new JsonResponse(['payload' =>  ["message" => "Jogo criado com sucesso."] ]);
    }


    public function initiative()
    {
        //create game order
        $this->load_game();
        $order = $this->game->roll_initiative();
        $this->save_game();

        $message = "A ordem de ataque será ".$this->game->players[$order[0]]->name .', depois '.$this->game->players[$order[1]]->name;

        return new JsonResponse(['payload' =>  ["message" => $message] ]);
    }

    public function attack()
    {
        // attack enemy
        $this->load_game();

        //create game order
        $damage_message = $this->game->run_turn();
        $this->save_game();

        return new JsonResponse(['payload' =>  ["message" => $damage_message] ]);
    }

    public function state()
    {
        // get game state
        $this->load_game();

        $result = array();
        $result['players']  = $this->game->players;
        $result['rounds']   = $this->game->rounds;
        $result['winner']   = $this->game->winner;

        return new JsonResponse(['payload' =>  $result ]);
    }

    //Save it for latter in session, by now

    public function save_game()
    {
        // TOTO save game data into database and return game_id
        $_SESSION['game'] = $this->game;
    }

    public function load_game()
    {
        // TOTO game_data sould be changed to game_id 
        if (isset($_SESSION['game']) && !empty($_SESSION['game']))
        {
            $this->game = $_SESSION['game'];
            $this->check_game();
        } else
        {
            $this->game         = new Game();
            $this->game->setup();
            $this->save_game();
        }
    }

    public function check_game()
    {
        if ($this->game->winner) {
            return new JsonResponse(['payload' =>  ["message" => 'Partida encerrada. '.$this->game->winner.' foi o vencedor.'] ]);
        }
    }
}