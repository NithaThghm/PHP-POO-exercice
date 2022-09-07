<?php

class Qcm
{
    private $form;

    public function __construct()
    {
        $this->form =
            "<form method ='post'>
                <fieldset>";
    }

    public function ajouterQuestion(Question $question, string $id, string $name): void
    {
        $this->form .= "<label>Question : " . $question->getQuestion() . "</label><br/><br/>";
        //var_dump($question -> getPropositions());
        foreach ($question->getPropositions() as $choix) {
            var_dump($choix->getProposition());
            $this->form .= "<label id ='$id' name='$name'>".$choix->getProposition()."</label><input id= '$id' name='$name' type='radio' value =".$choix->getValidation()."><br/><br/>";
        }
    }

    //Suleyman : Coder méthode setAppreciation :
    public function setAppreciation(Array $notes){
        foreach ($notes as $note){
            if ($note < 10){
                $this->form .= "<p>NUL !</p>";
            }
            else{
                $this->form .= "<p>BON !</p>";
            }
        }
    }

    //Fin code Suleyman

    public function generer()
    {
        return $this->form .= "
            <button type ='submit'>Valider</button>
           </fieldset>
        </form>";
    }
}

class Question
{
    private string $question;
    private array $propositions = [];
    private string $explication;

    public function __construct(string $question)
    {
        $this->question = $question;

    }

    public function ajouterReponse(Reponse $reponse): void
    {
        $this->propositions[] = $reponse;
    }

    public function setExplications(string $explication): void
    {
        $this->explication = $explication;
    }

    public function getPropositions()
    {
        return $this->propositions;
    }

    public function getQuestion()
    {
        return $this->question;
    }



}

class Reponse
{
    const BONNE_REPONSE = true;
    const MAUVAISE_REPONSE = false;

    private string $proposition;
    private bool $validation;

    public function __construct(string $proposition, bool $validation = Reponse::MAUVAISE_REPONSE)
    {
        $this->proposition = $proposition;
        $this->validation = $validation;
    }

    public function getProposition(): string
    {
        return $this->proposition;
    }

    public function getValidation(): bool
    {
        return $this->validation;
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
$qcm->ajouterQuestion($question2, "question2", "question2");

echo $qcm->generer();
echo '$_POST :'.var_dump($_POST);




