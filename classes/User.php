<?php

class User
{

    public static function register($nom, $prenom, $mail, $password) {
        $db = new Database();
        $password = sha1($password);
        $token = uniqid(sha1(date('Y-m-d|H:m:s')), false);

        $db->execute("INSERT INTO T_USERS
            (usenom, useprenom, usemail, usepassword, usetoken, id_groupes)
            VALUES ('$nom', '$prenom', '$mail', '$password', '$token', 3)");


        $message = "<h1>Wunderbar !!!</h1>";
        $message .= "<p>Vous êtes inscrit !!!</p>";
        $message .= "<p>Merci de cliquer sur le lien pour valider</p>";
        $message .= "<p><a href='http://localhost/AP17/index.php?";
        $message .= "page=validationInscription&amp;token=";
        $message .= $token;
        $message .= "&amp;id=";
        $message .= $db->getLastInsertId();
        $message .= "' target='_blank'>Lien</a>";

        ini_set("smtp_port", "1025");

        mail($mail, 'Confirmation compte', $message);
    }

    public static function login($mail, $password) {
        $db = new Database();
        $password = sha1($password);
        $res = $db->query("SELECT ID_USERS, USEMAIL, USENOM, USEPRENOM FROM T_USERS WHERE USEMAIL = '$mail' AND USEPASSWORD = '$password'")->fetch();
        if ($res != NULL) {
            $_SESSION['user_id'] = $res->ID_USERS;
            $_SESSION['user_mail'] = $res->USEMAIL;
            $_SESSION['user_nom'] = $res->USENOM;
            $_SESSION['user_prenom'] = $res->USEPRENOM;
            $_SESSION['user_timeout'] = time() +  (5 * 60 * 1000);
            return true;
        }
        return false;
    }

    public static function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_mail']);
        unset($_SESSION['user_nom']);
        unset($_SESSION['user_prenom']);
        unset($_SESSION['user_timeout']);
    }

    public static function isLogged() {
        if (isset($_SESSION['user_timeout'])) {
            $timeout = $_SESSION['user_timeout'];
            if ($timeout > time()) return true;
        }
        self::logout();
        return false;
    }

}