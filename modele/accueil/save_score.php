<?php
require_once '../../modele/connexion_sql.php';

function save_score($email, $score)
{
    global $bdd;

   
    // echo $score;
    $email = $bdd->quote($email);
     
    $req = $bdd->query("SELECT score FROM scores WHERE email = $email");
    $res = $req->fetch();

    settype($score,"int");
    // print($score);
    if ($res && $score > $res['score']  ) {
        // print_r($res);
        $bdd->query("UPDATE scores SET score = $score WHERE email = $email");
     }
}


