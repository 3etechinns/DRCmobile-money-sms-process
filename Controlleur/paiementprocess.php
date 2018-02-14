<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 4/6/17
 * Time: 1:20 PM
 */

require_once '../Model/Paiement.php';
include_once 'sessions.php';
if (isset( $_POST['montanttotal'])) {

    $montant = Paiement::totalpaye();
    echo $montant;
}
if (isset( $_POST['commandetotal'])) {

    $montant = Paiement::totalcommande();
    echo $montant;
}


if (isset( $_POST['dejapaye'])) {
    $montant = Paiement::totaldejapaye();
    echo $montant;
}

if (isset($_POST['limit']))
{
    $data = null;
    $compt = null;
    $tableaudist =Paiement::dernierpaiement();
    if ($tableaudist != null) {
        foreach ($tableaudist as $row) {
            $data=$data."<tr>
            <td>". $row->getIdpaiement()."</td>
            <td>".$row->getMontant()."</td>
            <td>".$row->getNumpaiement()."</td> 
            <td>".$row->getPanier()."</td>
            <td>".$row->getIdtrans()."</td>      
            </tr>";
        }
        echo $data;  // send data as json format
    }
}


if(isset($_POST['datachart']))
{
    $montant1= Paiement::totaldejapaye();
    $montant2 = Paiement::totalpaye();
    echo $montant2.';'.$montant1;


}

 if( isset($_POST['details'])) {
    $data =null;
    $compt = null;
    $email=null;
    if(isset($_SESSION['email']))
    {

        $email=$_SESSION['email'];
    }

    $tableau = Paiement::afficherpaiement($email);
    if ($tableau != null) {

        foreach ($tableau as $row) {
            $data=$data."<tr>
            <td>". $row->getIdPaiement()."</td>
            <td>".$row->getNumpaiement()."</td>
            <td>".$row->getDatepaiement()."</td>
            <td>".$row->getPanier()."</td>
            <td>".$row->getIdtrans()."</td>
            <td>".$row->getMontant()."</td>
            <td>".$row->getHeure()."</td>
  
            </tr>";


        }




    }
    echo $data;  // send data as json format
}

if(isset($_POST['mot'])) {

    $data = null;
    $compt = null;

    $tableaudist =Paiement::recherchepaiement($_POST['mot']);
    if ($tableaudist != null) {

        foreach ($tableaudist as $row) {
            $data=$data."<tr>
            <td>". $row->getIdPaiement()."</td>
            <td>".$row->getNumpaiement()."</td>
            <td>".$row->getDatepaiement()."</td>
            <td>".$row->getPanier()."</td>
            <td>".$row->getIdtrans()."</td>
            <td>".$row->getMontant()."</td>
            <td>".$row->getHeure()."</td>
  
            </tr>";

        }

        echo $data;  // send data as json format


    }
}
if(isset($_POST['sync'])) {

    $json=$_POST['sync'];

    if(get_magic_quotes_gpc())
    {
        $json=stripcslashes($json);
    }

    $a = array();
    $b = array();
    $data=json_decode($json);
    $tableau=null;
    for($i=0; $i<count($data);$i++)
    {
        $tableau=Paiement::afficherpaiement($data[$i]->shop);

    }
    if ($tableau != null) {

        foreach ($tableau as $row) {

            $b['id'] = $row->getIdPaiement();
            $b['idtrans'] = $row->getIdtrans();
            $b['numpaiement'] = $row->getNumpaiement();
            $b['datepaiement'] = $row->getDatepaiement();
            $b['montantpaiement'] = $row->getMontant();
            $b['heurepaiement'] = $row->getHeure();
            $b['devisepaiement'] = $row->getDevise();
            $b['shop'] = $row->getShop();
            $b['panier']=$row->getPanier();
            array_push($a, $b);


        }

        echo json_encode($a);

    }
}



if(isset($_POST['masc001']))
{
    $json=$_POST['masc001'];
    $message=null;

    if(get_magic_quotes_gpc())
    {
        $json=stripcslashes($json);
    }

    $data=json_decode($json);
    $a=array();
    $b=array();
    for($i=0; $i<count($data);$i++)
    {
        $message=$data[$i]->message;
        $shop=$data[$i]->shop;
        masc002($message,$shop);

    }
}


function masc002()
{
    $message1="Paiement effectue avec succes au 8294 - BELKIN par 243817805790 - Ruddy Kielo le 2017-08-26
Montant:8.000 Fc
Frais: 0 Fc
Ref: 4HQ95CFU0H
Solde Disponible: 1.000 Fc";
    $message2=strtolower($message1);
    $tabmsg=explode('le',$message2);
    $part1=$tabmsg[0];
    $part2=$tabmsg[1];
    $tabpart1=explode(' ',$part1);
    $tabpart2=explode(' ',$part2);
    $posmontant = strrpos($message2, "montant:");
    $posfrais = strrpos($message2, "frais:");
    $posref=strrpos($message2, "ref:");
    $posold=strrpos($message2, "solde");
    $posnum=strrpos($message2, "243");
    $posnumfin=$posnum+12;
    $nbcarref=$posold-$posref;
    $nbcarmnt=$posfrais-$posmontant;
    $num=substr($message2,$posnum,$posnumfin-$posnum);

    $heure = date("H:i:s");
    $montant1=substr($message2,$posmontant,$nbcarmnt);
    $ref1=substr($message2,$posref,$nbcarref);
    $ref=str_replace('ref:','',$ref1);
    $date=$today = date("m/d/Y");
    $devise=strchr($montant1,"fc");
    if($devise=="" OR $devise==null)
    {
        $devise="usd";
    }
    $montantp=strchr(str_replace('montant:','',$montant1),$devise,true);
    $montant=str_replace('.','',$montantp);

    echo "montant=".$montant."<br/>";
    echo "devise=".$devise."<br/>";
    echo "numeroclient=".$num."<br/>";
    echo "reference=".$ref."<br/>";
    echo "daterecption=".$date."<br/>";
    echo "heure=".$heure."<br/>";
    $paiement=new Paiement(null,$ref,$num,$date,$montant,$heure,$devise,null);
    Paiement::ajouterPaiement($paiement);

}

if(isset($_POST['validation_panier']))
{
    $json=$_POST['validation_panier'];
    $message=null;

    if(get_magic_quotes_gpc())
    {
        $json=stripcslashes($json);
    }

    $data=json_decode($json);
    $a=array();
    $b=array();
    for($i=0; $i<count($data);$i++)
    {

        $panier=$data[$i]->message;
        $transaction=$data[$i]->shop;
        Paiement::PanierTransaction($panier,$transaction);
    }
}
masc002();