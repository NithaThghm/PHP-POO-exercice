<?php

class Qcm
{
    protected $form;

    public function __construct(){
        $this -> form =
            "<form method ='post'>
                <fieldset>";
    }

    public function ajouterQuestion(Question $question, string $id, string $name): void
    {
        $this -> form .= "<label>Question : ".$question -> getQuestion()."</label><br/><br/>";
        //var_dump($question -> getReponses());
        foreach($question -> getReponses() as $choix){
            var_dump($choix -> proposition);
            $this -> form .= "<label>".$choix -> proposition."</label>
                              <input type='radio' value ='$choix->reponse'>
                              <br/><br/>";
        }
    }

    public function generer()
    {
        return $this -> form .= "
            <button type = 'post'>Valider</button>
           </fieldset>
        </form>";
    }
}

class Question
{
    public $question;
    public $reponses = [];
    public $explication;

    public function __construct(string $question)
    {
        $this -> question = $question;
    }

    public function ajouterReponse(Reponse $reponse): void
    {
        $this -> reponses[] = $reponse;
    }

    public function setExplications(string $explication)
    {
        $this -> explication = $explication;
    }

    public function getReponses()
    {
        return $this -> reponses;
    }

    public function getQuestion(){
        return $this -> question;
    }

}

class Reponse
{
    const BONNE_REPONSE = true;
    const MAUVAISE_REPONSE = false;

    public $proposition;
    public $reponse;

    public function __construct(string $proposition, bool $reponse = Reponse::MAUVAISE_REPONSE)
    {
       $this -> proposition = $proposition;
       $this -> reponse = $reponse;
    }
}

$qcm = new Qcm();

$question1 = new Question('Et paf, ça fait ...');
$question1->ajouterReponse(new Reponse('Des mielpops'));
$question1->ajouterReponse(new Reponse('Des chocapics', Reponse::BONNE_REPONSE));
$question1->ajouterReponse(new Reponse('Des actimels'));
$question1->setExplications('Et oui, la célèbre citation est « Et paf, ça fait des chocapics ! »');
$qcm->ajouterQuestion($question1, "question1", "question1");

$question2 = new Question('POO signifie');
$question2->ajouterReponse(new Reponse('Php Orienté Objet'));
$question2->ajouterReponse(new Reponse('ProgrammatiOn Orientée'));
$question2->ajouterReponse(new Reponse('Programmation Orientée Objet', Reponse::BONNE_REPONSE));
$question2->setExplications('Sans commentaires si vous avez eu faux :-°');
$qcm->ajouterQuestion($question2,"question2", "question2");

echo $qcm->generer();
var_dump($_POST);




