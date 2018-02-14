<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 4/6/17
 * Time: 1:46 PM
 */

require_once '../Model/Livraison.php';
if(isset($_POST['livretotal'])) {

    $nb =Paiement::totalpaiement();
    echo $nb;
}



if( isset($_POST['details'])) {
    $data =null;
    $compt = null;

    $tableau = Livraison::afficherLivraison();
    if ($tableau != null) {

        foreach ($tableau as $row) {
            $data=$data."<tr>
              <td>".$row->getIddistributeur()."</td>
            <td>". $row-> getIdlivraison()."</td>
            <td>".$row->getDatelivraison()."</td>
            <td>".$row->getNombrelivre()."</td>
            <td>".$row->getAgentlivreur()."</td>
        
               
            </tr>";



        }




    }
    echo $data;  // send data as json format
}

if(isset($_POST['mot'])) {

    $data = null;
    $compt = null;

    $tableaudist =Livraison::recherchelivraison($_POST['mot']);
    if ($tableaudist != null) {

        foreach ($tableaudist as $row) {
            $data=$data."<tr>
              <td>".$row->getIddistributeur()."</td>
            <td>". $row-> getIdlivraison()."</td>
            <td>".$row->getDatelivraison()."</td>
            <td>".$row->getNombrelivre()."</td>
            <td>".$row->getAgentlivreur()."</td>
        
               
            </tr>";

        }

        echo $data;  // send data as json format


    }
}



