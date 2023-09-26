<?php
session_start();
// session_destroy();
// On demande toutes les célébrités (modèle)
include_once('modele/accueil/get_celebrites.php');
include_once('modele/accueil/get_diff_valeurs.php');
include_once('modele/accueil/get_noms_colonnes.php');
include_once('modele/accueil/image_alea.php');
include_once('modele/accueil/meilleur_score.php');

$celebrites = array();
if ($_SESSION['email'] != '') {
    if (isset($_POST['celebrite'])) {
        $celebrites = get_celebrites('celebrites');
        $image = image_alea('celebrites');
        $nomColonnes = array('sexe', 'couleur de peau', 'cheuveux couleur', 'cheuveux texture', 'accessoires', 'couleur des yeux');
        $nomChamps = get_noms_colonnes($nomColonnes);
        $resultats = get_diff_valeurs($nomColonnes, 'celebrites');
    } elseif (isset($_POST['anime'])) {
        $celebrites = get_celebrites('dessin_animes');
        $image = image_alea('dessin_animes');
        $nomColonnes = array('genre', 'origine', 'cheveux', 'pelage', 'comportement', 'usage de la boca');
        $nomChamps = get_noms_colonnes($nomColonnes);
        $resultats = get_diff_valeurs($nomColonnes, 'dessin_animes');
    }

    // On effectue du traitement sur les données (contrôleur)
    // Ici, on doit surtout sécuriser l'affichage
    foreach ($celebrites as $cle => $celebrite) {
        $celebrites[$cle]['nom'] = htmlspecialchars($celebrite['nom']);
        $celebrites[$cle]['photo'] = nl2br(htmlspecialchars($celebrite['photo']));
    }
    // On affiche la page (vue)
    $meilleurScore = meilleur_score();

}


include_once('vue/accueil/index.php');
