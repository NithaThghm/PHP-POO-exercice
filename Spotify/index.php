<?php


try{
    include "./traits.php";
    include "./Album.php";
    include "./Artist.php";
    include "./Playlist.php";
    include "./Song.php";
    include "./Style.php";
    include "./User.php";

    ///// Création des styles \\\\\
    $style1 = new Style();
    $style1->setName('Heavy metal');
    $style2 = new Style();
    $style2->setName('Trash metal');
    $style3 = new Style();
    $style3->setName('Hard rock');
    var_dump($style1);

    ///// Création des artistes \\\\\
    $artist = (new Artist())
        ->setBeginningYear(1981)
        ->setNationality('American')
        ->addStyle($style1)
        ->addStyle($style2)
        ->addStyle($style3)
        ->setName('Metallica');

    $song = new Song();
    $song->setDuration('00:06:37');

    $song1 = new Song();
    $song1->setDuration('00:04:45');

    $album = new Album();
    $album->addSong($song);
    $album->addSong($song1);

    echo $album->getAlbumDuration();
    echo '<br>';

    $user = new User();
    $date = (new DateTime())
        ->setDate(1990, 1, 1);
    $user->setBirthDate($date);
    echo $user->getAge();

    echo '<br>';

    echo $artist;
    echo '<ul>';
    foreach ($artist->getStyles() as $style) {
        echo '<li>';
        echo $style;
        echo '</li>';
    }
    echo '</ul>';
} catch(Exception $e){
    var_dump($e);
}
var_dump('Hello');