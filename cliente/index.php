<?php
    session_name('chulettaaa');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/bootstrap.min.js" defer></script>
    <script src="../js/bootstrap.bundle.min.js" defer></script>
    <title>Área de Cliente</title>
</head>
<body>
    <h2>Área exclusiva de <?=$_SESSION['login_usuario']?></h2>
    <a href="../admin/logout.php" class="btn btn-danger">Sair <i class="bi bi-box-arrow-right"></i></a>
</body>
</html>