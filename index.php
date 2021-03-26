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
</head>
<body>
<?php
if (isset($_SESSION["email"])) {
    echo '<div>Vítaj ' . $_SESSION["name"] . ' ' . $_SESSION["surname"] . '</div>';
    echo '<div>' . $_SESSION["email"] . '</div>';
    echo '<div>' . $_SESSION["type"] . '</div>';
    echo '<a href="/authentication/api/logout.php"><h3>Log out</h3></a>';

} else {
    echo '<a href="/authentication/api/oauth2Api.php"><h3>Google prihlasenie</h3></a>';
    echo '<a href="/authentication/api/ldapApi.php"><h3>Stuba prihlasenie</h3></a>';
    include  __DIR__ . "/partials/loginform.php";
    include __DIR__ . "/partials/registerform.php";
}
?>
</body>
</html>