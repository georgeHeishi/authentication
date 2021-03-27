<?php
require_once(__DIR__ . "/classes/LoginAudit.php");
require_once(__DIR__ . "/classes/controllers/LoginAuditController.php");
session_start();
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Autentifikácia</title>
    <meta charset="UTF-8">
    <meta name="author" content="Juraj Lapčák">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="/authentication/assets/css/style.css" rel="stylesheet">
    <script src="/authentication/assets/js/script.js"></script>
</head>
<body>
<div class="container-fluid">
    <?php include("./partials/header.php"); ?>
    <div class="row mt-5">
        <div class="col-lg ">
            <main class="site-content">
                <?php
                if (isset($_SESSION["email"])) {
                    include __DIR__ . "/partials/page-user.php";
                } else {
                    include __DIR__ . "/partials/page-login.php";
                }
                ?>
            </main>
        </div>
    </div>
</div>
<?php include("./partials/footer.php"); ?>
</body>
</html>