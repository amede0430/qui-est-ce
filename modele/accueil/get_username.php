<?php
require_once '../../modele/connexion_sql.php';

function get_username($email)
{
    global $bdd;
        
    $email = $bdd->quote($email); 
    $req = $bdd->query("SELECT username FROM scores WHERE email = $email");
    
    return $req->fetch()['username'];
}

