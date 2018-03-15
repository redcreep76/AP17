<?php

if ((isset($_GET['id'])) && (isset($_GET['token'])))
{
    $id = $_GET['id'];
    $token = $_GET['token'];

    $db = new Database();

    $res = $db->query("SELECT ID_USERS FROM T_USERS 
                      WHERE ID_USERS = $id AND USETOKEN = '$token' AND USEMAILVALID = 0")->fetch();
    if ($res != NULL)
    {
        $db->execute("UPDATE T_USERS SET USEMAILVALID = 1 WHERE ID_USERS = $res->ID_USERS");
        echo "SUCCESS";
    } else {
        echo "<h1>INTRUSION DETECTEE !</h1>";
        echo "<img src='./assets/pictures/dalek.gif' alt='ALERTE !!'>";
    }
}
