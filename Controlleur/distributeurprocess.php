<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 4/6/17
 * Time: 2:14 PM
 */
require_once '../Model/Distributeur.php';
if (isset( $_POST['livretotal'])) {

    $nb =Paiement::totalpaiement();
    echo $nb;
}


else if( isset($_POST['details'])) {
    $data =null;
    $compt = null;

    $tableaudist = Distributeur::afficherDistributeurs();
    if ($tableaudist != null) {

        foreach ($tableaudist as $row) {
            $data=$data."<tr>
            <td>". $row->getIdDistributeur()."</td>
            <td>".$row->getNomdistributeur()."</td>
            <td>".$row->getAdresse()."</td>
            <td>".$row->getNumpersonnel()."</td>
            <td>".$row->getNumpesa()."</td>
            <td>".$row->getQuantite()."</td>
            <td>".$row->getAgentlivreur()."</td>
            <td>".$row->getCredittotal()."</td>
            <td>".$row->getDebittotal()."</td>
            
            
            
            </tr>";


        }




    }
    echo $data;  // send data as json format
}

else if(isset($_POST['mot'])) {

    $data = null;
    $compt = null;

    $tableaudist = Distributeur::recherchedistributeur($_POST['mot']);
    if ($tableaudist != null) {

        foreach ($tableaudist as $row) {


            $data=$data."<tr>
            <td>". $row->getIdDistributeur()."</td>
            <td>".$row->getNomdistributeur()."</td>
            <td>".$row->getAdresse()."</td>
            <td>".$row->getNumpersonnel()."</td>
            <td>".$row->getNumpesa()."</td>
            <td>".$row->getQuantite()."</td>
            <td>".$row->getAgentlivreur()."</td>
            <td>".$row->getCredittotal()."</td>
            <td>".$row->getDebittotal()."</td>
            
            
            
            </tr>";

        }

        echo $data;  // send data as json format


    }
}


else if(isset($_POST['limit'])) {

    $data = null;
    $compt = null;

    $tableaudist = Distributeur::recherchedistributeur($_POST['mot']);
    if ($tableaudist != null) {

        foreach ($tableaudist as $row) {


            $data=$data."<tr>
            <td>". $row->getIdDistributeur()."</td>
            <td>".$row->getNomdistributeur()."</td>
            <td>".$row->getAdresse()."</td>
            <td>".$row->getNumpersonnel()."</td>
            <td>".$row->getNumpesa()."</td>
            <td>".$row->getQuantite()."</td>
            <td>".$row->getAgentlivreur()."</td>
            <td>".$row->getCredittotal()."</td>
            <td>".$row->getDebittotal()."</td>
            
            
            
            </tr>";

        }

        echo $data;  // send data as json format


    }


}
if(isset($_POST['distributeurJSON']))
{
    $prix=prixlivre();
    $json=$_POST['distributeurJSON'];

    if(get_magic_quotes_gpc())
    {
        $json=stripcslashes($json);
    }

    $data=json_decode($json);
    $a=array();
    $b=array();
    for($i=0; $i<count($data);$i++)
    {
        $dist=new distributeur(null, $data[$i]->nomEcole, $data[$i]->adresse,$data[$i]->numPhonePerso, $data[$i]->numPhoneMpesa, $data[$i]->quantite, $data[$i]->nomAgent, prixlivre()*$data[$i]->quantite, 0);


        if (distributeur::insererdistributeur($dist))
        {
            $b["id"]=$data[$i]->Id_distributeur;
            $b["status"]="yes";
            array_push($a,$b);
        }
        else
        {
            $b["id"]=$data[$i]->Id_distributeur;
            $b["status"]="no";
            array_push($a,$b);

        }

    }

    echo json_encode($a);

}