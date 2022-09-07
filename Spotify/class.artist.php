<?php

include "traits.php";

class Artist
{

    use NameTrait;

    private $nationality;
    private $debutYear;
    private $albums;
    private $styles;
    

}

$artist1 = new Artist('Suleyman','Turc',1997,'Fuck CSS', 'Hard Rock');


var_dump($artist1);