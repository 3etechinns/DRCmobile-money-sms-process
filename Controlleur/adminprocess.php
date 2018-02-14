<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 4/6/17
 * Time: 11:19 AM
 */
require_once '../Model/Admin.php';
include_once "sessions.php";

$tableauadmin=array();


//controlleur connexion les donnes sont envoyees via ajax de la page login.php
if(isset($_POST['connexion']) ) {

    $tableauadmin = Admin::login($_POST['username'], $_POST['password']);

    if ($tableauadmin != null) {

        foreach ($tableauadmin as $admin) {
            $_SESSION['username'] = $admin->getUsername();
            $_SESSION['password'] = $admin->getPassword();
            $_SESSION['email'] = $admin->getEmail();
        }


        echo 'true';


    }
        else
        {

            echo 'false';

        }

}

    //controlleur deconnexion,les donnees sont envoyees via ajax sur la page index.php
if(isset($_POST['deconnexion']))

{

            unset($_SESSION['username']);
            unset($_SESSION['password']);
            unset($_SESSION['email']);
            echo 'true';


}




