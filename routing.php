<?php

use Syph\Routing\RouterCollection;

$router = new RouterCollection();

//index page
$router->add('/', 'RpgApp:HomeController:index');
//game page
$router->addGet(['path'=>'/game','name'=>'game' ], 'RpgApp:HomeController:game');

//BACKEND
//create game
$router->addGet(['path'=>'/create','name'=>'create' ], 'RpgApp:GameController:create');
//initiative roll
$router->addGet(['path'=>'/initiative','name'=>'initiative' ], 'RpgApp:GameController:initiative');
//attack enemy
$router->addGet(['path'=>'/attack','name'=>'attack' ], 'RpgApp:GameController:attack');
//get next attacker
$router->addGet(['path'=>'/attacker','name'=>'attacker' ], 'RpgApp:GameController:attacker');
//get game state
$router->addGet(['path'=>'/state','name'=>'state' ], 'RpgApp:GameController:state');