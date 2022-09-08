<?php
include 'traits.php';
include 'Style.php';


class Artist
{

    use NameTrait;
    private string $nationality;
    private DateTime $beginningYear;
    private string $albums;
    private array $style;



    public function setNationality(string $nationality){
        $this->nationality = $nationality;

    }
    public function setBeginningYear(DateTime $year){
        $this->beginningYear = $year;

    }
    public function addStyle(array $style){
        $this->style[] = $style;

    }

    // GETTER
    public function getNationality(){
        return $this->nationality;
    }
    public function getBeginningYear(){
        return $this->beginningYear;
    }
    public function getStyle(){
        return $this->style;
    }
}

$artist1 = new Artist();
$artist1->setName('Suleyman');
$artist1->setNationality('Turc');
$artist1->setBeginningYear(1997);
$artist1->addStyle($style1);
$artist1->addStyle($style2);
$artist1->addStyle($style3);

var_dump($artist1);