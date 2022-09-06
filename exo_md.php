<?php

/** Exercice 4 :
 *
 *Créez une classe nommée form représentant un formulaire HTML.
 *Le constructeur doit créer le code d’en-tête du formulaire en utilisant les éléments <form> et <fieldset>.
 *Une méthode setText() doit permettre d’ajouter une zone de texte. Une méthode setSubmit() doit permettre d’ajouter un bouton d’envoi.
 *Les paramètres de ces méthodes doivent correspondre aux attributs des éléments XHTML correspondants.
 * La méthode getForm() doit retourner tout le code XHTML de création du formulaire. Créez des objets form, et ajoutez-y deux zones de texte et un bouton d’envoi.
 * Testez l’affichage obtenu.
 */

class Form
{
    protected string $form;

    //en protected les enfants héritent de la propriété de class, le private l'interdit

    public function __construct(string $method)
    {
        $this->form = "<form method = $method
                <fieldset>";

    }

    public function setText(string $name, $placeholder = ''): void
    {
        $this->form .= "<input type='text' name='$name' placeholder='$placeholder'";
    }


    public function setSubmit(string $type): void
    {
        $this->form .= "<button type ='$type'>";
    }

    public function getForm(): string
    {
        return $this->form .= "    </fieldset>
               </form>";
    }
}

$form = new Form("post");
$form->setText("text");
$form->setText("text");
$form->setSubmit("submit");
echo $form->getForm();


/** Exercice 5 :
 *
 *Créez une sous-classe nommée form2 en dérivant la classe form de l’exercice 4.
 *Cette nouvelle classe doit permettre de créer des formulaires ayant en plus des boutons radio et des cases à cocher.
 *Elle doit donc avoir les méthodes supplémentaires qui correspondent à ces créations.
 *Créez des objets, et testez le résultat.
 */
class Form2 extends Form
{

    /**
     * @param string $label
     * @param string $name
     * @param string $id
     * @param string $value
     * @param string $placeholder
     * @return void
     */

    public function setRadio(string $label, string $name, string $id, string $value, string $placeholder = '')
    {
        $this->form .= "<label id = '$id'>$label</label>";
        $this->form .= "<input id = '$id' type = 'radio' name = '$name' placeholder = '$placeholder' value='$value'>";
    }

    public function setCheckbox(string $label, string $name, string $id, string $value, string $placeholder = '')
    {
        $name.'[]'; //on récupère le nom pour créer un array afin de pouvoir récupérer les réponses multiples.
        $this->form .= "<label id = '$id'>$label</label>";
        $this->form .= "<input id = '$id' type = 'checkbox' name = '$name' placeholder = '$placeholder' value='$value'>";
    }
}

$form2 = new Form2("post");
$form2->setText("text");
$form2->setText("text");
$form->setSubmit("submit");
echo $form->getForm();
var_dump($_POST);