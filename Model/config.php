<?php
/**
 * Created by PhpStorm.
 * User: samy
 * Date: 4/4/17
 * Time: 3:39 PM
 */

function connexion(){

try {
    $pdo = new PDO('mysql:host=db694019520.db.1and1.com;dbname=db694019520', 'dbo694019520', 'odidatabase2017');
    return $pdo;
}catch (Exception $e)
{
    die($e->getMessage());
    return null;
}



}

function connexion2(){

    try {
        $pdo1 = new PDO('mysql:host=db694340252.db.1and1.com;dbname=db694340252', 'dbo694340252', 'P@0^wE05');
        return $pdo1;
    }catch (Exception $e)
    {
        die($e->getMessage());

    }



}

