<?php

class Playlist
{
    use NameTrait;

    protected array $songs = [];
    protected DateTime $creationDate;
    protected DateTime $modificationDate;

    public function setCreationDate(string $date): void
    {
        $this->creationDate = DateTime::createFromFormat('d-m-Y', $date);
    }

    public function setModificationDate(string $date): void
    {
        $this->creationDate = DateTime::createFromFormat('d-m-Y', $date);
    }

    public function addSong(Song $song): void
    {
        $this->songs[] = $song;
    }

    public function getSongs(): array
    {
        return $this->songs;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }

    public function getModificationDate(): DateTime
    {
        return $this->modificationDate;
    }

}