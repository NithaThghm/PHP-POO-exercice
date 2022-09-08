<?php

include "traits.php";

class Song
{
    use NameTrait;

    protected DateTime $duration;
    protected array $artists = [];

    /**
     * $duration doit etre dans le format H:i:s
     *
     * @param string $duration
     * @return void
     */

    public function setDuration(string $duration): void
    {
        $this->duration = DateTime::createFromFormat('H:i:s', $duration);
    }

    public function getDuration(): DateTime
    {
        return $this->duration;
    }

    public function setArtists(Artist $artist): void
    {
        $this->artists[] = $artist;
    }

    public function getArtists(): array
    {
        return $this->artists;
    }

}

$song = new Song();
$song->setDuration('00:06:37');
var_dump($song->getDuration());