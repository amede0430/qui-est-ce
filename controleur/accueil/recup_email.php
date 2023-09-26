<?php
session_start();
include_once('../../modele/accueil/verifier_mail.php');
include_once('../../modele/accueil/get_username.php');


$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$emailCorrect=verifier_mail($email);

if ($emailCorrect) {
     $_SESSION['email']=$email;
     $_SESSION['username']=get_username($email);
 }else {
    $_SESSION['email']='';
    $_SESSION['username']='';
 }


 

header("Location:../../");


     

