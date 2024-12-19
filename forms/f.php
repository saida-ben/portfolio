<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/PHPMailer-master/src/Exception.php';
require '../PHPMailer/PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer/PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Paramètres du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Spécifiez le serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'benzariyasaida@gmail.com'; // Votre adresse email
        $mail->Password = 'saidatt44'; // Votre mot de passe ou mot de passe d'application
        $mail->SMTPSecure = 'tls'; // Activer le chiffrement TLS
        $mail->Port = 587; // Port TCP à utiliser

        // Destinataire et expéditeur
        $mail->setFrom($email, $name);
        $mail->addAddress('benzariyasaida@gmail.com'); // Adresse du destinataire

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = "Nouveau message de contact de $name";
        $mail->Body    = "Nom : $name<br>Email : $email<br>Message : $message";

        // Envoi de l'email
        $mail->send();
        echo 'Email envoyé avec succès.';
    } catch (Exception $e) {
        echo "Échec de l'envoi de l'email. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
