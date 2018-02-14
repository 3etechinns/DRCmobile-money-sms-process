<?php

/**
 * Created by PhpStorm.
 * User: samy
 * Date: 4/4/17
 * Time: 4:11 PM
 */
require_once 'config.php';
class distributeur
{
 private    $iddistributeur;
 private    $nomdistributeur;
 private    $adresse;
 private    $numpersonnel;
 private    $numpesa;
 private    $quantite;
 private    $agentlivreur;
 private    $credittotal;
 private    $debittotal;



    /**
     * distributeur constructor.
     * @param $iddistributeur
     * @param $nomdistributeur
     * @param $adresse
     * @param $numpersonnel
     * @param $numpesa
     * @param $quantite
     * @param $agentlivreur
     * @param $credittotal
     * @param $debittotal

     */
    public function __construct($iddistributeur, $nomdistributeur, $adresse, $numpersonnel, $numpesa, $quantite, $agentlivreur, $credittotal, $debittotal)
    {
        $this->iddistributeur = $iddistributeur;
        $this->nomdistributeur = $nomdistributeur;
        $this->adresse = $adresse;
        $this->numpersonnel = $numpersonnel;
        $this->numpesa = $numpesa;
        $this->quantite = $quantite;
        $this->agentlivreur = $agentlivreur;
        $this->credittotal = $credittotal;
        $this->debittotal = $debittotal;

    }

    /**
     * @return mixed
     */
    public function getCredittotal()
    {
        return $this->credittotal;
    }

    /**
     * @param mixed $credittotal
     */
    public function setCredittotal($credittotal)
    {
        $this->credittotal = $credittotal;
    }

    /**
     * @return mixed
     */
    public function getDebittotal()
    {
        return $this->debittotal;
    }

    /**
     * @param mixed $debittotal
     */
    public function setDebittotal($debittotal)
    {
        $this->debittotal = $debittotal;
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
     * @return mixed
     */
    public function getNomdistributeur()
    {
        return $this->nomdistributeur;
    }

    /**
     * @param mixed $nomdistributeur
     */
    public function setNomdistributeur($nomdistributeur)
    {
        $this->nomdistributeur = $nomdistributeur;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getNumpersonnel()
    {
        return $this->numpersonnel;
    }

    /**
     * @param mixed $numpersonnel
     */
    public function setNumpersonnel($numpersonnel)
    {
        $this->numpersonnel = $numpersonnel;
    }

    /**
     * @return mixed
     */
    public function getNumpesa()
    {
        return $this->numpesa;
    }

    /**
     * @param mixed $numpesa
     */
    public function setNumpesa($numpesa)
    {
        $this->numpesa = $numpesa;
    }

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
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



    public static function  insererdistributeur(distributeur $distributeur)
    {

        $connexion=connexion();
        $prix=prixlivre();
        $bool=false;
        if ($connexion != null) {


            $sql = "insert into distributeur(nomdistributeur,adresse,numpersonnel,numpesa,quantite,agentlivreur,credittotal) VALUES ('" . $distributeur->getNomdistributeur() . "','" . $distributeur->getAdresse() . "','" . $distributeur->getNumpersonnel() . "','" . $distributeur->getNumpesa() . "','" . $distributeur->getQuantite() . "','" . $distributeur->getAgentlivreur() . "','".$distributeur->getCredittotal()."')";
            try {
                $requete = $connexion->prepare($sql);
                $requete->execute();
                $bool=true;
            }
            catch (Exception $exception)
            {
                die($exception->getMessage());
            }




        }
        return $bool;
    }

    public function effacerdistributeur($iddistributeur)
    {
        $connexion=connexion();
        $sql="delete * from distributeur where iddistributeur='".$iddistributeur."'";
        if($connexion!=null)
        {
            if($connexion->query($sql))
            {
                echo "suppression reussie";
            }
            else
            {
                echo "impossible de supprimer veuilles contacter l'administrateur";

            }


        }
        else
        {
            echo "probleme de la base de donnnees veuillez contacter l'administrateur";
        }
    }

    public function modifierdistributeur(distributeur $distributeur)
    {
        $connexion=connexion();
        $sql="update distributeur set nomdistributeur='".$distributeur->getNomdistributeur()."',adresse='".$distributeur->getAdresse()."',numpersonnel='".$distributeur->getNumpersonnel()."',numpesa='".$distributeur->getNumpesa()."',quantite='".$distributeur->getQuantite()."',agentlivreur='".$distributeur->getAgentlivreur()."'";
        if($connexion!=null)
        {
            if ($connexion->query($sql))
            {
                echo "mise a jour reussie";
            }

            else
            {
                echo "impossible de faire la mise ajour";

            }
        }

        else
        {
            echo "probleme de la base de donnees veuillez contacter l'administrateur";
        }
    }


    public static function afficherdistributeurs()
    {
        $connexion=connexion();
        $tableaudistributeur=array();
        $sql="select * from distributeur";
        if ($connexion!=null)
        {
            $resultat=$connexion->prepare($sql);
            $resultat->execute();


                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaudistributeur[] = new distributeur
                    ($object->iddistributeur,
                        $object->nomdistributeur,
                        $object->adresse,
                        $object->numpersonnel,
                        $object->numpesa,
                        $object->quantite,
                        $object->agentlivreur,
                        $object->credittotal,
                        $object->debittotal

                    );
                }



        }
        else
        {
            echo "probleme de la base de donnees";
        }

        return $tableaudistributeur;

    }

    public static function afficherdistributeurlimit()
    {
        $connexion=connexion();
        $tableaudistributeur=array();
        $sql="select * from distributeur limit 5";
        if ($connexion!=null)
        {
            $resultat=$connexion->prepare($sql);
            $resultat->execute();


            while($object = $resultat->fetch(PDO::FETCH_OBJ))
            {
                $tableaudistributeur[] = new distributeur
                ($object->iddistributeur,
                    $object->nomdistributeur,
                    $object->adresse,
                    $object->numpersonnel,
                    $object->numpesa,
                    $object->quantite,
                    $object->agentlivreur,
                    $object->credittotal,
                    $object->debittotal

                );
            }



        }
        else
        {
            echo "probleme de la base de donnees";
        }

        return $tableaudistributeur;

    }

    public function afficherdistributeursParNumtel($numtel)
    {
        $connexion=connexion();
        $sql="select * from distributeur WHERE (numperseonnel='".$numtel."' OR numpesa='".$numtel."')";
        if ($connexion!=null)
        {
            $resultat=$connexion->query($sql);
            if($resultat->rowCount()>0)
            {
                $tableaudistributeur=array();
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaudistributeur[] = new distributeur
                    ($object->iddistributeur,
                        $object->nomdistributeur,
                        $object->adresse,
                        $object->numpersonnel,
                        $object->numpesa,
                        $object->quantite,
                        $object->agentlivreur,
                        $object->credittotal,
                        $object->debittotal

                    );
                }
                return $tableaudistributeur;
            }
            else
            {
                echo "Aucun distributeur trouve";
            }
        }
        else
        {
            echo "probleme de la base de donnee";
        }



    }


    public static function recherchedistributeur($mot)
    {
        $connexion=connexion();
        $tableaudistributeur=array();
        $sql="select * from distributeur WHERE (numpersonnel LIKE '%".$mot."%' OR numpesa LIKE '%".$mot."%' OR nomdistributeur LIKE'%".$mot."%' OR agentlivreur LIKE '%".$mot."%')";
        if ($connexion!=null)
        {
            $resultat=$connexion->prepare($sql);
            $resultat->execute();
               
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaudistributeur[] = new distributeur
                    ($object->iddistributeur,
                        $object->nomdistributeur,
                        $object->adresse,
                        $object->numpersonnel,
                        $object->numpesa,
                        $object->quantite,
                        $object->agentlivreur,
                        $object->credittotal,
                        $object->debittotal

                    );
                }
              
            }
        
        
        else
            {
                echo "probleme de la base de donnees";
            }

        return $tableaudistributeur;

    }


    public function quantiteInferieur($mot)
    {
        $connexion=connexion();
        $sql="select * from distributeur WHERE (quantite<'".$mot."' )";
        if ($connexion!=null)
        {
            $resultat=$connexion->query($sql);
            if($resultat->rowCount()>0)
            {
                $tableaudistributeur=array();
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaudistributeur[] = new distributeur
                    ($object->iddistributeur,
                        $object->nomdistributeur,
                        $object->adresse,
                        $object->numpersonnel,
                        $object->numpesa,
                        $object->quantite,
                        $object->agentlivreur,
                        $object->credittotal,
                        $object->debittotal

                    );
                }
                return $tableaudistributeur;
            }
            else
            {
                echo "Aucun distributeur trouve";
            }
        }
        else
            {
                echo "probleme de la base de donnees";
            }



    }


    public function quantiteSuperieur($mot)
    {
        $connexion=connexion();
        $sql="select * from distributeur WHERE (quantite>'".$mot."' )";
        if ($connexion!=null)
        {
            $resultat=$connexion->query($sql);
            if($resultat->rowCount()>0)
            {
                $tableaudistributeur=array();
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaudistributeur[] = new distributeur
                    ($object->iddistributeur,
                        $object->nomdistributeur,
                        $object->adresse,
                        $object->numpersonnel,
                        $object->numpesa,
                        $object->quantite,
                        $object->agentlivreur,
                        $object->credittotal,
                        $object->debittotal

                    );
                }
                return $tableaudistributeur;


            }

            else
            {
                echo "Aucun distributeur trouve";
            }
        }
        else
        {
            echo"probleme de la base de donnees";
        }

    }

    public function quantiteEgale($mot)
    {
        $connexion=connexion();
        $sql="select * from distributeur WHERE (quantite='".$mot."' )";
        if ($connexion!=null)
        {
            $resultat=$connexion->query($sql);
            if($resultat->rowCount()>0)
            {
                $tableaudistributeur=array();
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaudistributeur[] = new distributeur
                    ($object->iddistributeur,
                        $object->nomdistributeur,
                        $object->adresse,
                        $object->numpersonnel,
                        $object->numpesa,
                        $object->quantite,
                        $object->agentlivreur,
                        $object->credittotal,
                        $object->debittotal

                    );
                }
                return $tableaudistributeur;
            }
            else
            {
                echo "Aucun distributeur trouve";
            }

        }
        else
        {
            echo "probleme de la base de donnee";
        }



    }

    public static function totaldist()
    {
        $connexion = connexion();
        $nb = null;
        $sql = "select COUNT(iddistributeur) as disttotal from distributeur ";
        if ($connexion != null) {

            $resultat= $connexion->prepare($sql);
            $resultat->execute();


            while ($object = $resultat->fetch()) {
                $nb = $object['disttotal'];
            }


        }
        return $nb;

    }


}