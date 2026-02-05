<?php
require 'config.php';

$reservations = $pdo->query("SELECT * FROM reservations ORDER BY created_at DESC");
?>

<h2>Liste des réservations</h2>

<?php foreach ($reservations as $r): ?>
    <p>
        <?= htmlspecialchars($r['nom']) ?> –
        <?= htmlspecialchars($r['email']) ?> –
        <?= $r['date_reservation'] ?>
    </p>
<?php endforeach; ?>
