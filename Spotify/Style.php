<?php

class Style {
    use NameTrait;
}


$style1 = new Style();
$style1->setName('Heavy metal');
$style2 = new Style();
$style2->setName('Trash metal');
$style3 = new Style();
$style3->setName('Hard rock');


var_dump($style1);
var_dump($style2);
var_dump($style3);