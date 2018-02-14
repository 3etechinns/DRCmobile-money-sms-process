<?php

/**
 * Created by PhpStorm.
 * User: samy
 * Date: 4/5/17
 * Time: 10:10 AM
 */
require_once 'config.php';
class Livreur
{
    private $idlivreur;
    private $nomlivreur;
    private $numtel;

    /**
     * @return mixed
     */
    public function getIdlivreur()
    {
        return $this->idlivreur;
    }

    /**
     * @param mixed $idlivreur
     */
    public function setIdlivreur($idlivreur)
    {
        $this->idlivreur = $idlivreur;
    }

    /**
     * @return mixed
     */
    public function getNomlivreur()
    {
        return $this->nomlivreur;
    }

    /**
     * @param mixed $nomlivreur
     */
    public function setNomlivreur($nomlivreur)
    {
        $this->nomlivreur = $nomlivreur;
    }

    /**
     * @return mixed
     */
    public function getNumtel()
    {
        return $this->numtel;
    }

    /**
     * @param mixed $numtel
     */
    public function setNumtel($numtel)
    {
        $this->numtel = $numtel;
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
    private $password;

    /**
     * Livreur constructor.
     * @param $idlivreur
     * @param $nomlivreur
     * @param $numtel
     * @param $password
     */
    public function __construct($idlivreur, $nomlivreur, $numtel, $password)
    {
        $this->idlivreur = $idlivreur;
        $this->nomlivreur = $nomlivreur;
        $this->numtel = $numtel;
        $this->password = $password;
    }

    public static  function ajouterLivreur(Livreur $livreur)

    {
        $bool=false;

        $connexion=connexion();
        $sql="insert into livreur(nomlivreur,numtel) VALUES ('".$livreur->getNomlivreur()."','".$livreur->getNumtel()."')";
        if($connexion!=null)
        {

            try{
            $connexion->query($sql);



                $bool=true;


            }

            catch (Exception $exception)
                {
                   $bool=false;

                }

        }
        else
        {
            echo "probleme de la base donnees";
        }
        return $bool;

    }
public function modifierLivreur(Livreur $livreur)
{
    $connexion=connexion();
    $sql="update livreur set nomlivreur='".$livreur->getNomlivreur()."',numtel='".$livreur->getNumtel()."',password='".$livreur->getPassword()."' where idlivreur='".$livreur->getIdlivreur()."'";
    if($connexion!=null)
    {
        if($connexion->query($sql))
        {
            echo "modification reussie";
        }
        else
        {
            echo "modification non reussie";
        }
    }

    else
    {
        echo"probleme de la base donnees veuilleez contacter l'administrateur";
    }
}

public function supprimerLivreur($idlivreur)
{

    $connexion=connexion();
    $sql="delete * from livreur WHERE idlivreur='".$idlivreur."'";
    if($connexion!=null)
    {
        if($connexion->query($sql))
        {
            echo "suppressionreussie";

        }
        else
        {
            echo "suppression non reussie";
        }


    }

    else
    {
        echo "probleme de la base de donnees veuillez contacter l'administrateur";
    }


}

public static function afficherLivreur()
{
    $connexion=connexion();
    $tableaulivreur=array();
    $sql="select * from livreur ";
    if($connexion!=null)
    {

        $resultat=$connexion->prepare($sql);
        $resultat->execute();


            while($object = $resultat->fetch(PDO::FETCH_OBJ))
            {
                $tableaulivreur[] = new Livreur
                ($object->idlivreur,
                    $object->nomlivreur,
                    $object->numtel,
                    $object->password

                );
            }





    }
    return $tableaulivreur;

}


    public static  function afficherLivreurParnumEtpass($numtel,$password)
    {
        $connexion=connexion();
        $tableaulivreur=array();
        $sql="select * from livreur WHERE (numtel='".$numtel."' AND password='".$password."')";
        if($connexion!=null)
        {

            $resultat=$connexion->prepare($sql);
            $resultat->execute();


                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaulivreur[] = new Livreur
                    ($object->idlivreur,
                        $object->nomlivreur,
                        $object->numtel,
                        $object->password

                    );
                }



        }

        return $tableaulivreur;


    }


    public static function recherchelivreur($mot)
    {
        $connexion=connexion();
        $tableau=array();
        $sql="select * from livreur WHERE (idlivreur LIKE '%".$mot."%' OR nomlivreur LIKE '%".$mot."%' OR numtel LIKE'%".$mot."%' )";
        if ($connexion!=null)
        {
            $resultat=$connexion->prepare($sql);
            $resultat->execute();

            while($object = $resultat->fetch(PDO::FETCH_OBJ))
            {
                $tableau[] = new Livreur
                ($object->idlivreur,
                    $object->nomlivreur,
                    $object->numtel,
                    $object->password

                );
            }

        }


        else
        {
            echo "probleme de la base de donnees";
        }

        return $tableau;

    }



}