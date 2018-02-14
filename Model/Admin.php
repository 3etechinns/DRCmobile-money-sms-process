<?php

/**
 * Created by PhpStorm.
 * User: samy
 * Date: 4/5/17
 * Time: 10:05 AM
 */
require_once 'config.php';
class Admin
{
    private $idadmin;
    private $username;
    private $password;
    private $email;

    /**
     * @return mixed
     */
    public function getIdadmin()
    {
        return $this->idadmin;
    }

    /**
     * @param mixed $idadmin
     */
    public function setIdadmin($idadmin)
    {
        $this->idadmin = $idadmin;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $type
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Admin constructor.
     * @param $idadmin
     * @param $username
     * @param $password
     * @param $type
     */
    public function __construct($idadmin, $username, $password, $email)
    {
        $this->idadmin = $idadmin;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
    public static function creerAdmin(Admin $admin)
    {
        $connexion=connexion();
        $sql="insert into Admin(null,'".$admin->getUsername()."','".$admin->getPassword()."','".$admin->getType()."')";
        if($connexion!=null)
        {
            if($connexion->query($sql))
            {
                return "Creation Admin reussie";
            }
            else
            {
                return "Creation admin non reussie";
            }
        }
        else
        {
            return "probleme de la base de donnee veuillez contacter l'administrateur";
        }

    }

    public static function modifierAdmin(Admin $admin)
    {

        $connexion=connexion();
        $sql="update admin set username='".$admin->getUsername()."',password='".$admin->getPassword()."',type='".$admin->getType()."'";
        if($connexion!=null)
        {
            if($connexion->query($sql))
            {
                return "Modification reussie";
            }
            else
                {
                    return "Modification non reussie";
                }
        }
        else
        {
            return "probleme de la base de donnees veuillez contacter l'administrateur";
        }

    }


    public static function supprimerAdmin($username)
    {
        $connexion=connexion();
        $sql="delete * from admin WHERE usename='".$username."'";
        if($connexion!=null)
        {
            if($connexion->query($sql))
            {
                return "suppression reussie";
            }
            else
            {
                return "suppression non reussie";
            }
        }
        else
        {
            return "probleme de la base de donnees";
        }
    }

    public static function afficherAdmin()
    {
        $connexion=connexion();
        $sql="select * from admin";
        if($connexion!=null)
        {

            $resultat=$connexion->query($sql);
            if($resultat)
            {
                $tableauadmin=array();


                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableauadmin[] = new Admin
                    ($object->idadmin,
                        $object->username,
                        $object->password,
                        $object->email

                    );
                }
                return $tableauadmin;

            }
            else
            {
                return null;
            }

        }
        else
        {
            return "probleme de la base de donnee";
        }
    }

    public static function login($username, $password)
    {
        $tableauadmin=array();
        $connexion=connexion();
        $sql="select * from admin WHERE (email= '".$username."' AND password='".$password."')";
        if($connexion!=null)
        {

            $resultat= $connexion->prepare($sql);
            $resultat->execute();
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableauadmin[] = new Admin
                    ($object->idadmin,
                        $object->username,
                        $object->password,
                        $object->email

                    );
                }
            }
            else
            {
                return "probleme de la base de donnees";
            }
        return $tableauadmin;

        }


}