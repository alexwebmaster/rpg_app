<?php
namespace RpgApp\Classes;

class Dice
{
    var $faces = 6; //set default to 6

    function __construct($faces)
    {
        $this->faces = $faces;
    }

    public function roll()
    {
        return rand(1, $this->faces);
    }
}