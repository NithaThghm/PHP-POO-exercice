<?php

include "./traits.php";

class Album
{
    use NameTrait;
    protected DateTime $year;
    protected float $prize;
    protected array $songs = [];

    public function setDate(string $year): void
    {
        $this->year = DateTime::createFromFormat('Y', $year);
    }

    public function setPrize(float $prize): void
    {
        $this->prize = $prize;
    }

    public function addSongs(Song $song): void
    {
        $this->songs[]=$song;
    }

    public function getDate(): DateTime
    {
        return $this->year;
    }

    public function getPrize(): float
    {
        return $this->prize;
    }

    public function getSongs(): array
    {
        return $this->songs;
    }

}