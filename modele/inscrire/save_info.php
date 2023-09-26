<?php

require_once '../../modele/connexion_sql.php';

function save_info($email, $username)
{
    global $bdd;
     $email = $bdd->quote($email); // Échapper les valeurs pour éviter les injections SQL
     $username = $bdd->quote($username);
    $req = $bdd->query("SELECT id FROM scores WHERE email = $email");
    $getId = $req->fetch();
    if ($getId) {
        return false;
    }

    $req = $bdd->query("INSERT INTO scores (email, username, score) VALUES ($email, $username, 0)");
    return true;
}

