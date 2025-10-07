<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

// Message de confirmation vide par défaut
$feedback = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et sécurisation des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Paramètres SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sarahsebei@gmail.com';      // Ton Gmail
        $mail->Password   = 'kjfk nlfm wyya sfls';          // Mot de passe App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // **Ignorer la vérification SSL**
        $mail->SMTPOptions = [
        'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    ]
];


        // Expéditeur (doit être ton Gmail pour que ça fonctionne)
        $mail->setFrom('sarahsebei@gmail.com', 'MonCV Formulaire');

        // Destinataire (toi)
        $mail->addAddress('sarahsebei@gmail.com');      

        // Contenu du mail
        $mail->Subject = 'Nouveau message depuis le formulaire de contact';
        $mail->Body    = "Nom: $nom\nPrénom: $prenom\nMessage:\n$message";

        // Envoi du mail
        $mail->send();
        echo "Message envoyé avec succès !";
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi du message : {$mail->ErrorInfo}";
    }
} else {
    echo "Aucune donnée reçue.";
}
