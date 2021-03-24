<?php
require_once(__DIR__ . "/classes/LoginAudit.php");
require_once(__DIR__ . "/classes/cotrollers/LoginAuditController.php");
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
</head>
<body>
<?php
if (isset($_SESSION["email"])) {
    echo '<div>Vítaj ' . $_SESSION["name"] . ' ' . $_SESSION["surname"] . '</div>';
    echo '<div>' . $_SESSION["email"] . '</div>';
    echo '<div>' . $_SESSION["type"] . '</div>';
    echo '<div>' . $_SESSION["tmp"] . '</div>';
    echo '<a href="/authentication/api/logout.php"><h3>Log out</h3></a>';

} else {
    echo '<a href="/authentication/api/oauth2.php"><h3>Google prihlasenie</h3></a>';
    echo '<a href="/authentication/api/ldap.php"><h3>Stuba prihlasenie</h3></a>';
}
?>
</body>
</html>