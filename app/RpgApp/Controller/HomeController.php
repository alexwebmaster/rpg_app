<?php
namespace RpgApp\Controller;

use Syph\Controller\BaseController;
use Syph\View\View;

class HomeController extends BaseController
{
    public function index()
    {
        echo  "Describe the Game";
    }

    public function game()
    {
        echo  "Show The Game";
    }
}