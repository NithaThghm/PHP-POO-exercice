<?php

class Qcm
{
    private string $form;
    private array $questions = [];
    private array $appreciation = [];
    private float $userNote = 0;

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
    public function setAppreciation(array $appreciation)
    {
        foreach ($appreciation as $key => $appr) {
            if (is_numeric($key))
                $this->appreciation[(int) $key] = $appr;
            else {
                list($min, $max) = explode('-', $key);
                if ($min > $max)
                    list($min, $max) = array($max, $min);
                for ($i = (int)$min; $i <= $max; $i++)
                    $this->appreciation[$i] = $appr;
            }
        }
    }


    //Fin code Suleyman

    public function generer()
    {
        $note = 20/count($this->questions);
        var_dump($note);
        var_dump($this->userNote);

        foreach ($this->questions as $key => $value) {
            $this->form .= "<p>Question : " . $value->getQuestion() . "</p>";

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
                                    $this->userNote =  $this->userNote + $note;
                                } else {
                                    $this->form .= "<p>Désolé, mauvaise réponse</p>";
                                }
                            }
                        }
                    }
                }
            }

            $this->form .= "<hr/>";
        }

        if(isset($_POST) && !empty($_POST)){
            $this->form.="<p>Vous avez obtenu une note de : ".$this->userNote."/20</p><p>Appréciation : ".$this->appreciation[$this->userNote]."</p><hr/>";
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

$qcm->setAppreciation(array('0-10' => 'Pas top du tout ...', '10-20' => 'Très bien ...'));

echo $qcm->generer();
var_dump($_POST);




