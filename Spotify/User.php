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
