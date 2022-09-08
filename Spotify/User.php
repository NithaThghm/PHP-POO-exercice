<?php
include 'traits.php';

class User
{
    use NameTrait;
    public DateTime $birthdate;


    public function setBirthDate(DateTime $date){
        $this->birthdate = $date;
    }

    public function getAge() {
        //return idate('Y') - $this->date->format('Y');
        $today = new DateTime();
        $age = $today->diff($this->birthdate);
        return $age->y;

    }
}

$user = new User();
$date = new DateTime();
$date->setDate(1992, 1, 1);
$user->setBirthDate($date);
echo $user->getAge();
//var_dump((new DateTime())->diff($user->birthdate));