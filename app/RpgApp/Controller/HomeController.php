<?php
namespace RpgApp\Controller;

use Syph\Controller\BaseController;
use Syph\View\View;

class HomeController extends BaseController
{
    public function index()
    {
        return View::render($this->createView('RpgApp:example/index.html.twig'));
    }

    public function game()
    {
        return View::render($this->createView('RpgApp:example/game.html.twig'));
    }
}