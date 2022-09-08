<?php

class Artist
{

    use NameTrait;
    private string $nationality;
    private int $beginningYear;
    private array $albums = [];
    private array $styles = [];

    // method magique

    public function __toString(): string
    {
        return $this->name . ' ' . $this->nationality . ' - ' . $this->beginningYear;
    }


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
        $this->styles[] = $style->getName();
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
    public function getStyles(): array
    {
        return $this->styles;
    }
}
