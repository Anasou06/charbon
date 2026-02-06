<?php
include  "../includes/config.php";
include '../includes/header.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $date = $_POST['date_reservation'];
    $places = (int) $_POST['places'];

    $sql = "SELECT SUM(places) AS total FROM reservations WHERE date_reservation = :date";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':date' => $date]);
    $result = $stmt->fetch();

    $places_deja_prises = $result['total'] ?? 0;

    if ($places_deja_prises + $places > PLACES_MAX) {
        echo "❌ Désolé, il ne reste plus assez de places pour cette date.";
        exit;
    }

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




if (isset($_POST["submit"])){

$date = $_POST["date"];
$heuredebut = $_POST["heure_debut"];
$heurefin = $_POST["heure_fin"];

$date_debut_heure = $date  . " " . $heuredebut ;
$date_debut_fin = $date ." " . $heurefin ;

var_dump($date_debut_heure ." ". $date_debut_fin);
}


?>

<div class="container">
    <h2>Réservation</h2>
    <form method="post" action="reserver.php">

        <input
            type="text"
            name="nom"
            placeholder="description"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="Votre email"
            required
        >

        <input
            type="date"
            name="date"
            required
        >
            <input
            type="time"
            name="heure_debut"
            required
        >
              <input
            type="time"
            name="heure_fin"
            required
        >

        <input
            type="number"
            name="places"
            min="1"
            max="70"
            value="1"
            required
        >
        

    
        <button type="submit" name="submit">Réserver</button>

    </form>
    <!-- <form method="post" action="reserver.php">

        <input
            type="text"
            name="nom"
            placeholder="description"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="Votre email"
            required
        >

        <input
            type="datetime-local"
            name="date_debut"
            required
        >
            <input
            type="datetime-local"
            name="date_fin"
            required
        >

        <input
            type="number"
            name="places"
            min="1"
            max="70"
            value="1"
            required
        >
        

    
        <button type="submit" name="submit">Réserver</button>

    </form> -->
</div>