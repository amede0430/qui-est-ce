<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../../modele/connexion_sql.php';
include_once('../../modele/accueil/save_score.php');


// Inclusion des fichiers PHPMailer
require '../../modele/PHPMailer/src/PHPMailer.php';
require '../../modele/PHPMailer/src/SMTP.php';
require '../../modele/PHPMailer/src/Exception.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


global $bdd;
$req = $bdd->query("SELECT Max(score) as meilleurScore FROM scores LIMIT 1");
$res=$req->fetch();
$bestScore=$res['meilleurScore'];
$score = $_POST['scoreFinal'];

if ($score >= $bestScore) {
    $donnees = array(); // Variable pour stocker les données des joueurs ayant le meilleur score

    try {
       
        $req = $bdd->query("SELECT email, username, score FROM scores WHERE score = $bestScore");
        $donnees = $req->fetchAll();
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des données : " . $e->getMessage();
    }
    $mail = new PHPMailer(true);
    //Server settings
    // $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'jeuquiestce@gmail.com';                     //SMTP username
    $mail->Password   = 'lnbqrebzgxftybvy';                               //SMTP password
    $mail->SMTPSecure = 'ssl';           //Enable implicit TLS encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    // Expéditeur
    $mail->setFrom('jeuquiestce@gmail.com', 'Qui est-ce?');

    foreach ($donnees as $donnee) {
        try {
            
            // Destinataire
            $mail->addAddress($donnee['email'], $donnee['username']);

            // Répondre à
            $mail->addReplyTo($donnee['email'], 'Information');

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Information';

            if ($score == $bestScore) {
                $mail->Body = $donnee['username'] . '!!! Vous n\'allez pas le croire :). Il a égalé votre score (' . $score . '), son nom c\'est: ' . $_SESSION['username'] . '. Faites un tour sur notre site pour reprendre les rennes.';
            } elseif ($score > $bestScore) {
                $mail->Body = $donnee['username'] . '!!! Vous n\'allez pas le croire :). Il a dépassé votre score (' . $score . '), son nom c\'est: ' . $_SESSION['username'] . '. Faites un tour sur notre site pour reprendre les rennes.';
            }

            // Envoyer l'e-mail
            $mail->send();

            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

save_score($_SESSION['email'], $score);
header("Location:../../");
?>
