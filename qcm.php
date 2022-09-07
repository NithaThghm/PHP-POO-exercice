<?php

class Qcm
{
    private string $form;
    private array $questions=[];

    public function __construct()
    {
        $this->form =
            "<form method ='post'>
                <fieldset>";
    }

    public function ajouterQuestion(Question $question, string $id, string $name): void
    {
        $this->questions[] = $question;

    }


    //Suleyman : Coder méthode setAppreciation :
    public function setAppreciation(array $notes)
    {
        foreach ($notes as $note) {
            if ($note < 10) {
                $this->form .= "<p>NUL !</p>";
            } else {
                $this->form .= "<p>BON !</p>";
            }
        }
    }

    //Fin code Suleyman

    public function generer()
    {
        foreach ($this->questions as $questionSet){
            $this->form .= "<br/><p>Question : " . $questionSet->getQuestion() . "</p>";
            //var_dump($questionSet->getPropositions());
            foreach($questionSet->getPropositions() as $propositionSet){
                var_dump($propositionSet->getProposition());
                $this->form .="<input name='".$questionSet->getQuestion()."' type='radio' value='".$propositionSet->getProposition()."'><label id='".$questionSet->getQuestion()."'>".$propositionSet->getProposition()."</label><br/>";
            }
        }


        $this->form .= "
            <br/>
            <button type ='submit'>Valider</button>
            <br/>
           </fieldset>
        </form>";

        return $this->form;
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
echo '$_POST :' . var_dump($_POST);




