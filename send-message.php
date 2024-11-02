<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Chemin vers le fichier autoload de Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturer les données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $postal = htmlspecialchars($_POST['postal']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'homerenovations91@gmail.com'; // Remplace par ton adresse Gmail
        $mail->Password = 'kksk bbtf ycgr uqzs'; // Remplace par ton mot de passe d'application Gmail
        $mail->SMTPSecure = 'ssl'; // Changer en 'ssl' pour le port 465
        $mail->Port = 465;

        // Désactiver temporairement la vérification SSL
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Expéditeur et destinataire
        $mail->setFrom('homerenovations91@gmail.com', 'Homerenov91'); // Utilisez votre adresse Gmail ici
        $mail->addReplyTo($email, $name); // Adresse de réponse de l'utilisateur
        $mail->addAddress('homerenovations91@gmail.com'); // Votre email pour recevoir les messages

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = "Nouveau message de $name";
        $mail->Body = "Nom : $name<br>Email : $email<br>Téléphone : $phone<br>Code Postal : $postal<br><br>Message :<br>$message";

        // Envoyer le message
        if ($mail->send()) {
            // Rediriger vers la page de remerciement
            header('Location: merci.html');
            exit(); // S'assurer que le script s'arrête après la redirection
        }
    } catch (Exception $e) {
        echo "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
    }
}
?>
