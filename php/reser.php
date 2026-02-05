<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $date = $_POST['date_reservation'];
    $places = (int) $_POST['places'];

    // 1️⃣ Compter les places déjà réservées pour cette date
    $sql = "SELECT SUM(places) AS total FROM reservations WHERE date_reservation = :date";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':date' => $date]);
    $result = $stmt->fetch();

    $places_deja_prises = $result['total'] ?? 0;

    // 2️⃣ Vérifier la disponibilité
    if ($places_deja_prises + $places > PLACES_MAX) {
        echo "❌ Désolé, il ne reste plus assez de places pour cette date.";
        exit;
    }

    // 3️⃣ Enregistrer la réservation
    $sql = "INSERT INTO reservations (nom, email, date_reservation, places)
            VALUES (:nom, :email, :date, :places)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':date' => $date,
        ':places' => $places
    ]);

    echo "✅ Réservation confirmée !";
}
