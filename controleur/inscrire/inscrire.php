<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../../modele/PHPMailer/src/PHPMailer.php';
require '../../modele/PHPMailer/src/SMTP.php';
require '../../modele/PHPMailer/src/Exception.php';
include_once('../../modele/inscrire/save_info.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null; // Vérifier si les clés existent
$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : null;
$confirme=true;
if ($email && $username) { // Vérifier si les valeurs sont présentes
    $confirme = save_info($email, $username);

    if ($confirme) {
        //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

        try {
           //Server settings
            // $mail->SMTPDebug = 2;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'jeuquiestce@gmail.com';                     //SMTP username
            $mail->Password   = 'lnbqrebzgxftybvy';                         // 'hoxtnvrxvfxjemok';                               //SMTP password
            $mail->SMTPSecure = 'ssl';           //Enable implicit TLS encryption
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('jeuquiestce@gmail.com', 'Qui est-ce?');
            // $mail->addAddress('amedeflorianktm@gmail.com', 'Joe User');     //Add a recipient
        
            // Expéditeur
            // $mail->setFrom('jeuquiestce@gmail.com', 'Mailer');
            
            // Destinataire
            $mail->addAddress($email, $username);
            
            // Répondre à
            $mail->addReplyTo($email, 'Information');
            
            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = "Confirmation d'inscription";
            $mail->Body =  'Hello '.$username.'! Vous venez de vous inscrire sur le site du jeu "Qui est-ce ?", réalisé par le groupe 2 EDL. 
            Nous vous tiendrons informer des nouvelles sur le site.
            Merci et faite une bonne partie avec un record historique :) !!!' . $score;
            
            // Envoyer l'e-mail
            $mail->send();
        
        echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        header("Location:../../"); // Redirection vers le chemin absolu
        // exit(); // Arrêter l'exécution du script après la redirection
    }
    // On affiche la page (vue)
}

include_once('../../vue/inscrire/inscrire.php');



