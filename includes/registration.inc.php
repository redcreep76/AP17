<h1>Registration</h1>
<?php
if (User::isLogged()) {
    Redirection::redirect("?page=home");
    exit;
}

$name = Form::validate($_POST['name'] ?? "");
$firstName = Form::validate($_POST['firstName'] ?? "");
$mail = Form::validate($_POST['mail'] ?? "");
$password = Form::validate($_POST['password'] ?? "");

if (isset($_POST['frmRegistration'])) {
    $errors = array();
    if ($name == "") array_push($errors, "Veuillez saisir un nom.");
    if ($firstName == "") array_push($errors, "Veuillez saisir un prénom.");
    if ($mail == "") array_push($errors, "Veuillez saisir un mail.");
    if ($password == "") array_push($errors, "Veuillez saisir un mot de passe.");
}

if ((isset($errors)) && (empty($errors))) {
    User::register($name, $firstName, $mail, $password);
    echo "<p><b>Un mail de confirmation à été envoyé à votre adresse mail.</b></p>";
} else {
    if (!empty($errors)) {
        $message = "<ul>";
        foreach ($errors as $key) {
            $message .= "<li>$key</li>";
        }
        $message .= "</ul>";
        echo $message;
    }
    Form::open();
    echo "<div>";
    Form::label("name", "Nom: ");
    Form::input("name", ["value" => $name]);
    echo "</div>";
    echo "<div>";
    Form::label("firtName", "Prénom: ");
    Form::input("firstName", ["value" => $firstName]);
    echo "</div>";
    echo "<div>";
    Form::label("mail", "E-mail: ");
    Form::input("mail", ["type" => "email", "value" => $mail]);
    echo "</div>";
    echo "<div>";
    Form::label("password", "Mot de passe: ");
    Form::input("password", ["type" => "password"]);
    echo "</div>";
    echo "<div>";
    Form::input("frmReset", array("type" => "reset", "value" => "Effacer"));
    Form::input("frmRegistration", ["type" => "submit", "value" => "Envoyer"]);
    echo "</div>";
    Form::close();
}
