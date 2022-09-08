<?php
include 'traits.php';
include 'Style.php';


class Artist
{

    use NameTrait;
    private string $nationality;
    private int $beginningYear;
    private array $albums = [];
    private array $styles = [];


    public function setNationality(string $nationality): void
    {
        $this->nationality = $nationality;
    }

    public function setBeginningYear(int $year): void
    {
        $this->beginningYear = $year;
    }

    public function addStyle(Style $style): void
    {
        $this->styles[] = $style;
    }

    // GETTER
    public function getNationality(): string
    {
        return $this->nationality;
    }
    public function getBeginningYear(): int
    {
        return $this->beginningYear;
    }
    public function getStyle(): array
    {
        return $this->styles;
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