<?php
require_once 'modele/connexion_sql.php';

function get_noms_colonnes($noms)
{
    $nomChamps=array();
    for ($i = 0; $i < count($noms); $i++) {
        $nomChamps[$i]=str_replace(' ', '_', $noms[$i]);
    }
    return $nomChamps;
}
?>

