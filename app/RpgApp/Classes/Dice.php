<?php
namespace RpgApp\Classes;

class Dice
{
    var $faces;

    function __construct($faces= 6)  //set default to 6
    {
        $this->faces = $faces;
    }

    public function roll()
    {
        return rand(1, $this->faces);
    }
}