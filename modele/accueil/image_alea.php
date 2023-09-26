<?php
require_once 'modele/connexion_sql.php';

function image_alea($table)
{
    global $bdd;

    $randomId=rand(1,20);
    $req = $bdd->query("SELECT * FROM `$table` WHERE id=$randomId");
    $randPerson = $req->fetch();
    return $randPerson;
}
?>