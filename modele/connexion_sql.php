<?php
// Connexion à la base de données
try
{
$bdd = new PDO('mysql:host=localhost;dbname=qui_est_ce', 'root', '');

}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}