<?php 
include '../includes/header.php'; 
include "./config.php";

$places_restantes = PLACES_MAX;

if (!empty($_GET['date'])) {
    $date = $_GET['date'];

    $stmt = $pdo->prepare(
        "SELECT SUM(places) AS total FROM reservations WHERE date_reservation = :date"
    );
    $stmt->execute([':date' => $date]);
    $res = $stmt->fetch();

    $prises = $res['total'] ?? 0;
    $places_restantes = PLACES_MAX - $prises;
}

?>
<?php if ($places_restantes <= 0): ?>
    <p class="error">❌ Cette date est complète</p>
<?php else: ?>
<?php endif; ?>

<div class="page">
<h1>Ceci est un site qui vous permets de prendre un rendez-vous avec Apoutchou Eipstein !</h1>
<div class="box">
    <a>
        <img src = "../image/chica-rizz-rizz.gif" alt="GIF">
    </a>
    <a>
        <img src = "../image/freddy-mewing.gif" alt="GIF">
    </a>
</div>
</div>
<p class="info">
    Places restantes : <strong><?= $places_restantes ?></strong>
</p>

<?php include '../includes/footer.php'; ?>
