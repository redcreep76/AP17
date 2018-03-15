<h1>Login</h1>
<?php

if (User::isLogged()) {
    Redirection::redirect("?page=home");
    exit;
}
$mail = Form::validate($_POST['mail'] ?? "");
$password = Form::validate($_POST['password'] ?? "");

if (isset($_POST['frmLogin'])) {
    $errors = array();
    if ($mail == "") array_push($errors, "Veuillez saisir un mail." );
    if ($password == "") array_push($errors,"Veuillez saisir un mot de passe.");

    if (empty($errors)) {
        if (User::login($mail, $password)) {
            Redirection::redirect("?page=home");
            exit;
        } else {
            array_push($errors, "Votre mail ou votre mot de passe sont invalides.");
        }
    }

    $message = "<ul>";
    foreach ($errors as $key) {
        $message .= "<li>$key</li>";
    }
    $message .= "</ul>";
    echo $message;
}
Form::open();
echo "<div>";
Form::label("mail", "E-mail: ");
Form::input("mail", array("type" => "email", "value" => $mail));
echo "</div>";
echo "<div>";
Form::label("password", "Mot de passe: ");
Form::input("password", array("type" => "password"));
echo "</div>";
echo "<div>";
Form::input("frmReset", array("type" => "reset", "value" => "Effacer"));
Form::input("frmLogin", array("type" => "submit", "value" => "Envoyer"));
echo "</div>";
Form::close();