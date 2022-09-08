<?php

class Album
{
    use NameTrait;
    protected DateTime $year;
    protected float $prize;
    protected array $songs = [];
    protected DateTime $duration;

    public function setDate(string $year): void
    {
        $this->year = DateTime::createFromFormat('Y', $year);
    }

    public function setPrize(float $prize): void
    {
        $this->prize = $prize;
    }

    public function addSong(Song $song): void
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
    public function getDuration($duration): DateTime
    {
        return $this->duration->format('H:i:s');
    }

    public function getAlbumTotalDuration()
    {
        foreach($this->songs as $song)
        {
            var_dump($song);
            echo $song->getDuration();
        }
    }

}