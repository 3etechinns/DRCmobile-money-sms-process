<?php

/**
 * Created by PhpStorm.
 * User: samy
 * Date: 4/5/17
 * Time: 11:29 AM
 */
require_once 'config.php';
class Livraison
{
    private $idlivraison;
    private $datelivraison;
    private $nombrelivre;
    private $agentlivreur;
    private $iddistributeur;

    /**
     * @return mixed
     */
    public function getIdlivraison()
    {
        return $this->idlivraison;
    }

    /**
     * @param mixed $idlivraison
     */
    public function setIdlivraison($idlivraison)
    {
        $this->idlivraison = $idlivraison;
    }

    /**
     * @return mixed
     */
    public function getDatelivraison()
    {
        return $this->datelivraison;
    }

    /**
     * @param mixed $datelivraison
     */
    public function setDatelivraison($datelivraison)
    {
        $this->datelivraison = $datelivraison;
    }

    /**
     * @return mixed
     */
    public function getNombrelivre()
    {
        return $this->nombrelivre;
    }

    /**
     * @param mixed $nombrelivre
     */
    public function setNombrelivre($nombrelivre)
    {
        $this->nombrelivre = $nombrelivre;
    }

    /**
     * @return mixed
     */
    public function getAgentlivreur()
    {
        return $this->agentlivreur;
    }

    /**
     * @param mixed $agentlivreur
     */
    public function setAgentlivreur($agentlivreur)
    {
        $this->agentlivreur = $agentlivreur;
    }

    /**
     * @return mixed
     */
    public function getIddistributeur()
    {
        return $this->iddistributeur;
    }

    /**
     * @param mixed $iddistributeur
     */
    public function setIddistributeur($iddistributeur)
    {
        $this->iddistributeur = $iddistributeur;
    }

    /**
     * Livraison constructor.
     * @param $idlivraison
     * @param $datelivraison
     * @param $nombrelivre
     * @param $agentlivreur
     * @param $iddistributeur
     */
    public function __construct($idlivraison, $datelivraison, $nombrelivre, $agentlivreur, $iddistributeur)
    {
        $this->idlivraison = $idlivraison;
        $this->datelivraison = $datelivraison;
        $this->nombrelivre = $nombrelivre;
        $this->agentlivreur = $agentlivreur;
        $this->iddistributeur = $iddistributeur;
    }

    public function insererlivraison(Livraison $livraison)
    {

        $connexion=connexion();
        $sql="insert into livraison(null,'".$livraison->getDatelivraison()."','".$livraison->getNombrelivre()."','".$livraison->getAgentlivreur()."','".$livraison->getIddistributeur()."') ";
        if(connexion()!=null)
        {

            if($connexion->query($sql))
            {
                echo "insertion reussie";
            }
            else
            {
                echo "insertion non reussie";
            }

        }
        else
        {
            echo "probleme de la base de donnees";
        }


    }

    public function annulerLivraison($idlivraison)
    {

        $connexion=connexion();
        $sql="delete * from livraison WHERE idlivraison='".$idlivraison."'";
        if($connexion!=null)
        {
            if($connexion->query($sql))
            {
                echo "suppression reussie reussie";
            }
            else
            {
                echo "suppression non reussie";
            }

        }

        else
        {
            echo "probleme de la base de donnnees";
        }

    }

    public static function afficherLivraison()
    {

        $connexion=connexion();
        $tableaulivraison=array();
        $sql="select * from livraison INNER join distributeur on (livraison.iddistributeur=distributeur.iddistributeur) INNER JOIN appli774640.livreur ON (appli774640.livreur.idlivreur=appli774640.livraison.agentlivreur)";
        if($connexion!=null)
        {
            $resultat=$connexion->query($sql);
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaulivraison[] = new Livraison
                    ($object->iddistributeur,
                        $object->datelivraison,
                        $object->nombrelivre,
                        $object->nomlivreur,
                        $object->nomdistributeur

                    );
                }
        }
        return $tableaulivraison;

    }




    public function afficherLivraisonParDate($date)
    {

        $connexion=connexion();
        $sql="select * from livraison WHERE datelivraison='".$date."'";
        if($connexion!=null)
        {
            $resultat=$connexion->query($sql);
            if($resultat->rowCount()>0)
            {

                $tableaulivraison=array();
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaulivraison[] = new Livraison
                    ($object->idlivraison,
                        $object->datelivraison,
                        $object->nombrelivre,
                        $object->agentlivreur,
                        $object->iddistributeur

                    );
                }
                return $tableaulivraison;



            }


        }

    }



    public function afficherLivraisonParLivreur($livreur)
    {

        $connexion=connexion();
        $sql="select * from livraison WHERE agentlivreur='".$livreur."'";
        if($connexion!=null)
        {
            $resultat=$connexion->query($sql);
            if($resultat->rowCount()>0)
            {

                $tableaulivraison=array();
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaulivraison[] = new Livraison
                    ($object->idlivraison,
                        $object->datelivraison,
                        $object->nombrelivre,
                        $object->agentlivreur,
                        $object->iddistributeur

                    );
                }
                return $tableaulivraison;



            }


        }

    }



    public function afficherLivraisonParNombreLivre($nombre)
    {

        $connexion=connexion();
        $sql="select * from livraison WHERE nombrelivre='".$nombre."'";
        if($connexion!=null)
        {
            $resultat=$connexion->query($sql);
            if($resultat->rowCount()>0)
            {

                $tableaulivraison=array();
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaulivraison[] = new Livraison
                    ($object->idlivraison,
                        $object->datelivraison,
                        $object->nombrelivre,
                        $object->agentlivreur,
                        $object->iddistributeur

                    );
                }
                return $tableaulivraison;



            }


        }

    }





    public static function totallivre()
    {
        $connexion = connexion();
        $nb= null;
        $sql = "select SUM(nombrelivre) as livre_total from livraison ";
        if ($connexion != null) {

            $resultat= $connexion->prepare($sql);
            $resultat->execute();


            while ($object = $resultat->fetch()) {
                $nb = $object['livre_total'];
            }


        }
        return $nb;

    }

    public static function recherchelivraison($mot)
    {
        $connexion=connexion();
        $tableau=array();
        $sql="select * from livraison WHERE (idlivraison LIKE '%".$mot."%' OR datelivraison LIKE '%".$mot."%' OR nombrelivre LIKE'%".$mot."%' OR agentlivreur LIKE '%".$mot."%' OR iddistributeur LIKE '%".$mot."%')";
        if ($connexion!=null)
        {
            $resultat=$connexion->prepare($sql);
            $resultat->execute();

            while($object = $resultat->fetch(PDO::FETCH_OBJ))
            {
                $tableau[] = new Livraison
                ($object->idlivraison,
                    $object->datelivraison,
                    $object->nombrelivre,
                    $object->agentlivreur,
                    $object->iddistributeur

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