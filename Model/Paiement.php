<?php

/**
 * Created by PhpStorm.
 * User: samy
 * Date: 4/5/17
 * Time: 10:03 AM
 */
require_once 'config.php';
include_once '../Controlleur/sessions.php';
class Paiement
{
    private $idpaiement;
    private $idtrans;
    private $numpaiement;
    private $datepaiement;
    private $montant;
    private $heure;
    private $devise;
    private $panier;

    /**
     * Paiement constructor.
     * @param $idpaiement
     * @param $idtrans
     * @param $numpaiement
     * @param $datepaiement
     * @param $montant
     * @param $heure
     * @param $devise
     */
    public function __construct($idpaiement, $idtrans, $numpaiement, $datepaiement, $montant, $heure, $devise,$panier)
    {
        $this->idpaiement = $idpaiement;
        $this->idtrans = $idtrans;
        $this->numpaiement = $numpaiement;
        $this->datepaiement = $datepaiement;
        $this->montant = $montant;
        $this->heure = $heure;
        $this->devise = $devise;
        $this->panier=$panier;
    }

    /**
     * @return mixed
     */
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * @return mixed
     */
    public function getPanier()
    {
        return $this->panier;
    }

    /**
     * @param mixed $panier
     */
    public function setPanier($panier)
    {
        $this->panier = $panier;
    }




    /**
     * @return mixed
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }


    /**
     * @return mixed
     */
    public function getIdpaiement()
    {
        return $this->idpaiement;
    }

    /**
     * @param mixed $idpaiement
     */
    public function setIdpaiement($idpaiement)
    {
        $this->idpaiement = $idpaiement;
    }

    /**
     * @return mixed
     */
    public function getNumpaiement()
    {
        return $this->numpaiement;
    }

    /**
     * @param mixed $numpaiement
     */
    public function setNumpaiement($numpaiement)
    {
        $this->numpaiement = $numpaiement;
    }

    /**
     * @return mixed
     */
    public function getDatepaiement()
    {
        return $this->datepaiement;
    }

    /**
     * @param mixed $datepaiement
     */
    public function setDatepaiement($datepaiement)
    {
        $this->datepaiement = $datepaiement;
    }

    /**
     * @return mixed
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return mixed
     */
    public function getIdtrans()
    {
        return $this->idtrans;
    }

    /**
     * @param mixed $idtrans
     */
    public function setIdtrans($idtrans)
    {
        $this->idtrans = $idtrans;
    }



    public static  function ajouterPaiement(Paiement $paiement)
    {
        $connexion=connexion();
        $connexion2=connexion2();
        $bool=false;
        $sql="INSERT INTO `paiement` (`idpaiement`, `numpaiement`, `datepaiement`, `montant`, `heure`,`idtrans`) VALUES (?, ?,?, ?,?,?)";
       $sql2="UPDATE mk_appusers set user_wallet=user_wallet+? where phone=?";
        if($connexion != null AND $connexion2 != null)
        {
            try{

                $requete=$connexion->prepare($sql);
                $requete->bindParam(1,$paiement->getIdpaiement());
                $requete->bindParam(2,$paiement->getNumpaiement());
                $requete->bindParam(3,$paiement->getDatepaiement());
                $requete->bindParam(4,$paiement->getMontant());
                $requete->bindParam(5,$paiement->getHeure());
                $requete->bindParam(6,$paiement->getIdtrans());
                $requete->execute();
              
                $bool=true;
            }

            catch (Exception $exception)
            {
                echo "insertion paiement impossible";

            }

               try{

                $requete2=$connexion2->prepare($sql2);
                $requete2->bindParam(1, $paiement->getMontant());
                $requete2->bindParam(2,$paiement->getNumpaiement());
                $requete2->execute();
               }
               catch (Exception $exception2)

               {

                   die($exception2->getMessage());

               }



        }



        echo $paiement->getMontant().$paiement->getNumpaiement();

    }


    public static function afficherpaiement($shop)
    {

        $connexion=connexion();
        $tableaupaiement=array();
        $sql="select * from paiement ORDER BY idpaiement desc";
        if($connexion!=null)
        {

            $resultat=$connexion->query($sql);


                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaupaiement[] = new Paiement
                    ($object->idpaiement,
			            $object->idtrans,
                        $object->numpaiement,
                        $object->datepaiement,
                        $object->montant,
                        $object->heure,
                        $object->devise,
                        $object->panier
                    );
                }



        }
        return $tableaupaiement;
    }


    public function afficherpaiementParDate($date)
    {
        $connexion=connexion();
        $tableaupaiement=array();
        $sql="select * from paiement WHERE datepaiement='".$date."'";
        if($connexion!=null)
        {

            $resultat=$connexion->prepare($sql);


                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaupaiement[] = new Paiement
                    ($object->idpaiement,
                        $object->numpaiement,
                        $object->datepaiement,
                        $object->montant,
                        $object->heure,
                        $object->shop,
                        $object->idtrans,
                        $object->devise,
                        $object->panier
                    );
                }



        }
        return $tableaupaiement;
    }

    public  function afficherpaiementParDistributeur($numpaiement)
    {
        $connexion=connexion();
        $sql="select * from paiement WHERE numpaiement='".$numpaiement."'";
        if($connexion!=null)
        {

            $resultat=$connexion->query($sql);
            if($resultat)
            {
                $tableaupaiement=array();
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaupaiement[] = new Paiement
                    ($object->idpaiement,
                        $object->numpaiement,
                        $object->datepaiement,
                        $object->montant,
                        $object->heure,
                        $object->shop,
                        $object->idtrans,
                        $object->devise,
                        $object->panier
                    );
                }
                return $tableaupaiement;
            }

        }

    }

    public static function totalpaye()

    {
        $email=null;
        if(isset($_SESSION['email']))
        {
            $email=$_SESSION['email'];
        }
        $connexion = connexion();
        $montant = null;
        $sql = "select SUM(montant) as montant_total from paiement WHERE shop ='".$email."' ";
        if ($connexion != null) {

            $resultat= $connexion->prepare($sql);
            $resultat->execute();


                while ($object = $resultat->fetch()) {
                    $montant = $object['montant_total'];
                }


        }
        return $montant;

    }




    public static  function dernierpaiement()
    {
        $email=null;
        if(isset($_SESSION['email']))
        {
            $email=$_SESSION['email'];
        }
        $connexion=connexion();
        $tableaupaiement=array();
        $sql="select * from paiement WHERE shop ='".$email."' limit 5";
        if($connexion!=null)
        {

            $resultat=$connexion->prepare($sql);
            $resultat->execute();
                while($object = $resultat->fetch(PDO::FETCH_OBJ))
                {
                    $tableaupaiement[] = new Paiement
                    ($object->idpaiement,
                        $object->idtrans,
                        $object->numpaiement,
                        $object->datepaiement,
                        $object->montant,
                        $object->heure,
                        $object->shop,
                        $object->devise,
                        $object->panier
                    );
                }



        }
        return $tableaupaiement;

    }


    public static function recherchepaiement($mot)
    {
        $email=null;
        if(isset($_SESSION['email']))
        {
            $email=$_SESSION['email'];
        }
        $connexion=connexion();
        $tableaupaiement=array();
        $sql="select * from paiement WHERE (idpaiement LIKE '%".$mot."%' OR numpaiement LIKE '%".$mot."%' OR datepaiement LIKE'%".$mot."%' OR montant LIKE '%".$mot."%' AND  shop='".$email."')";
        if ($connexion!=null)
        {
            $resultat=$connexion->prepare($sql);
            $resultat->execute();

            while($object = $resultat->fetch(PDO::FETCH_OBJ))
            {
                $tableaupaiement[] = new Paiement
                ($object->idpaiement,
                    $object->idtrans,
                    $object->numpaiement,
                    $object->datepaiement,
                    $object->montant,
                    $object->heure,
                    $object->shop,

                    $object->devise,
                    $object->panier
                );
            }

        }


        else
        {
            echo "probleme de la base de donnees";
        }

        return $tableaupaiement;

    }

    public static function totalcommande()
    {
        $email=null;
        if(isset($_SESSION['email']))
        {
            $email=$_SESSION['email'];
        }
        $connexion = connexion();
        $nb = null;
        $sql = "select COUNT(idpaiement) as disttotal from paiement WHERE  shop='".$email."'";
        if ($connexion != null) {

            $resultat= $connexion->prepare($sql);
            $resultat->execute();


            while ($object = $resultat->fetch()) {
                $nb = $object['disttotal'];
            }


        }
        return $nb;

    }

    public static  function PanierTransaction($panier,$transaction)
    {
        $connexion=connexion();
        $bool=false;
        $sql="UPDATE `paiement`  set panier='".$panier."' where idtrans='".$transaction."'";
        if($connexion!=null)
        {
            try{

                $requete=$connexion->prepare($sql);
                $requete->execute();
                $bool=true;
            }

            catch (Exception $exception)
            {
                echo "mise a jour impossible";

            }
        }
        return $bool;



    }
}

