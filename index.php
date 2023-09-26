<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once('modele/connexion_sql.php');
if (!isset($_GET['section']) OR $_GET['section'] == 'index')
{
include_once('controleur/accueil/index.php');
}