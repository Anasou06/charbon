<?php
include '../includes/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>

<h1>Bienvenue <?= $_SESSION['user']['nom'] ?> !!</h1>
<div id = "divprofile">
<a class = "lienprofile" href="edit.php">Modifier le profil</a><br>
<a class = "lienprofile" href="delete.php">Supprimer le profil</a><br>
<a class = "lienprofile" href="logout.php">Déconnexion</a>
</div>
<?php include '../includes/footer.php'; ?>
