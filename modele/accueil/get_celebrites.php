<?php
require_once 'modele/connexion_sql.php';

function get_celebrites($table)
{
    global $bdd;
    $req = $bdd->query("SELECT * FROM `$table` ORDER BY RAND()");
    $celebrites = $req->fetchAll();
    return $celebrites;
}
?>





