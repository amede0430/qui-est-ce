<?php
require_once 'modele/connexion_sql.php';

function meilleur_score()
{
    global $bdd;

    $req = $bdd->query("SELECT Max(score) as meilleurScore FROM scores LIMIT 1");
    $res=$req->fetch();
    return $res['meilleurScore'];
}