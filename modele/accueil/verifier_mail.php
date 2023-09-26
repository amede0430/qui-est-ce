<?php
require_once '../../modele/connexion_sql.php';

function verifier_mail($email)
{
    global $bdd;
        
    if ($email === null) {
        return false;
    }
    
    $email = $bdd->quote($email); 
    $req = $bdd->query("SELECT id FROM scores WHERE email = $email");
    $getId = $req->fetch();
    
    if($getId){
        return true;
    }
    
    return false;
}

