<?php

use Syph\Core\Kernel;

class AppKernel extends Kernel
{

    public function registerApps(){
        $apps = array(

            new RpgApp\RpgApp(),

        );
        return $apps;
    }
}