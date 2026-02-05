<?php include '../includes/header.php'; ?>
<?php
if (!empty($_POST["submit"])) {
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => $_POST['username']
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
     
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user;
        $_SESSION['id'] = $user['id'];      
        $_SESSION['username'] = $user["username"];
        if($_SESSION["user"]["username"] === "adminadmin") {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: profile.php");
            exit();
        }
    } else {
        $error = "Identifiant ou mot de passe incorrect.";
    }
}
?>

<?php if (isset($_GET['error'])): ?>
    <p style="color:red;">Vous devez être connecté pour laisser un avis.</p>
<?php endif; ?>

<link href  = "../css/index.css" rel = "stylesheet">    

<form method="post">
    <p>Informations de connexion</p>
    <div>
        <input type="text" name="username" placeholder="Identifiant" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="submit" name="submit" value="Connexion">
    </div>
    <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
</form>
