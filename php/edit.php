<?php
include '../includes/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (!empty($_POST)) {

    $sql = "UPDATE users 
            SET username = :username 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => $_POST['username'],
        ':id' => $_SESSION['user']['id']
    ]);

    $_SESSION['user']['username'] = $_POST['username'];
    header("Location: profile.php");
}
?>

<link href = "../css/edit.css" rel = "stylesheet">
<h1>Ici vous pouvez modifier votre nom prénom et Identifiant</h1>
<form method="post">
    <input type="text" name="nom" value="<?= $_SESSION['user']['nom'] ?>">
    <input type="text" name="prenom" value="<?= $_SESSION['user']['prenom'] ?>">
    <input type="text" name="username" value="<?= $_SESSION['user']['username'] ?>">
    <button>Modifier</button>
</form>
