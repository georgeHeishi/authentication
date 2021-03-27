<?php
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
    <?php include(__DIR__ . "/partials/header.php"); ?>
    <div class="row mt-5">
        <div class="col-lg ">
            <main class="site-content">
                <div class="d-flex flex-column">
                    <div class="flex-row d-flex justify-content-center mb-2">
                        <h4>Stuba login</h4>
                    </div>
                    <div class="flex-row d-flex justify-content-center">
                        <?php include(__DIR__ . '/partials/form-ldap.php') ?>
                    </div>
                    <div class="flex-row d-flex justify-content-center mt-2 ">
                        <a href="https://wt98.fei.stuba.sk/authentication/" class="back">
                            <p>
                                Späť na regulárne prihlásenie
                            </p>
                        </a>
                    </div>
                    <div class="flex-row d-flex justify-content-center">
                        <p class="error-text">
                            <?php
                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == 1) {
                                    echo "Prihlásenie zlyhalo: Skontrolujte svoje prihlasovacie meno a heslo";
                                }
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<?php include(__DIR__ . "/partials/footer.php"); ?>
</body>
</html>