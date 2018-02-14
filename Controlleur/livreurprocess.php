<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 4/6/17
 * Time: 1:20 PM
 */

require_once '../Model/Livreur.php';



if( isset($_POST['details'])) {
    $data =null;
    $compt = null;

    $tableau = Livreur::afficherLivreur();
    if ($tableau != null) {

        foreach ($tableau as $row) {
            $data=$data."<tr>
            <td>". $row->getIdLivreur()."</td>
            <td>".$row->getNomLivreur()."</td>
            <td>".$row->getNumtel()."</td>
            </tr>";


        }




    }
    echo $data;
}

if(isset($_POST['mot'])) {

    $data = null;
    $compt = null;

    $tableaudist =Livreur::recherchelivreur($_POST['mot']);
    if ($tableaudist != null) {

        foreach ($tableaudist as $row) {
            $data=$data."<tr>
            <td>". $row->getIdLivreur()."</td>
            <td>".$row->getNomLivreur()."</td>
            <td>".$row->getNumtel()."</td>
            </tr>";

        }

        echo $data;


    }
}

if(isset($_POST['ajout']))
{


    $livreur=new Livreur("",$_POST['nom'],$_POST['numtel'],"");
    if(Livreur::ajouterLivreur($livreur))
    {
        echo "ajout reussi";
    }

    else
    {
        echo "ajout non reussi";
    }


}

if(isset($_POST['userJSON']))
{

    $json=$_POST['userJSON'];

    if(get_magic_quotes_gpc())
    {
        $json=stripcslashes($json);
    }

    $data=json_decode($json);
    $a=array();
    $b=array();
    for($i=0; $i<count($data);$i++)
    {
        $tableau=Livreur::afficherLivreurParnumEtpass($data[$i]->loginUser,$data[$i]->passwordUser);
        $a=array();
        $b=array();
        if($tableau!=null) {
            foreach ($tableau as $item) {
                $b["id"] = $item->getIdlivreur();
                $b["nom"]=$item->getNomlivreur();
                $b["status"] = "yes";
                array_push($a, $b);
            }
        }

        else
        {
            $b["status"] = "no";
            array_push($a, $b);

        }
    }
    echo $_POST['loginUser'].$_POST['passwordUser'];

}