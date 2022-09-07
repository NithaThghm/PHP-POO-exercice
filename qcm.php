<?php

class Qcm
{
    private string $form;
    private array $questions = [];
    public integer $note;

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
    public function setAppreciation(array $array)
    {
        if ($this->note == 0) {
            $this->form .= "<p>Note : " . $this->note / 40 * 20 . "/20 " . $array[0] . "</p>";
        }
        if ($this->note == 10) {
            $this->form .= "<p>Note : " . $this->note / 40 * 20 . "/20 " . $array[5] . "</p>";
        }
        if ($this->note == 20) {
            $this->form .= "<p>Note : " . $this->note / 40 * 20 . "/20 " . $array[10] . "</p>";
        }
        if ($this->note == 30) {
            $this->form .= "<p>Note : " . $this->note / 40 * 20 . "/20 " . $array[15] . "</p>";
        }
        if ($this->note == 40) {
            $this->form .= "<p>Note : " . $this->note / 40 * 20 . "/20 " . $array[20] . "</p>";
        }
    }

    public function ajouterpoint()
    {
        $this->note += 10;
        return $this->note;
    }

    //Fin code Suleyman

    public function generer()
    {

        foreach ($this->questions as $key => $value) {
            $this->form .= "<br/><p>Question : " . $value->getQuestion() . "</p>";

            foreach ($value->getPropositions() as $propositionSet) {
                $this->form .= "<input name='$key' type='radio' value='" . $propositionSet->getProposition() . "'><label id='$key'>" . $propositionSet->getProposition() . "</label><br/>";
            }

            if (isset($_POST) && !empty($_POST)) {
                foreach ($_POST as $key2 => $value2) {
                    if ($key2 == $key) {
                        foreach ($value->getPropositions() as $propositionSet) {
                            if ($value2 == $propositionSet->getProposition()) {
                                if ($propositionSet->getValidation()) {
                                    $this->form .= "<p>'" . $value->getExplication() . "'</p>";
                                } else {
                                    $this->form .= "<p>Désolé, mauvaise réponse</p>";
                                }
                            }
                        }
                    }
                }
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

    public function getExplication()
    {
        return $this->explication;
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
var_dump($_POST);




