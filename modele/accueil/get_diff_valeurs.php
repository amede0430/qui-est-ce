<?php
require_once 'modele/connexion_sql.php';

function get_diff_valeurs($nomColonne,$table)
{
    global $bdd;
    $resultats = array();

    for ($i = 0; $i < count($nomColonne); $i++) {
        $champ=str_replace(' ', '_', $nomColonne[$i]);

        $req = $bdd->query("SELECT `$champ` FROM `$table` where `$champ` !='' GROUP BY `$champ` ");
        $resultat = $req->fetchAll();

        $resultats[$i] = $resultat;
    }
    return $resultats;
}

?>

