<div class="d-flex flex-column login">
    <div class="flex-row d-flex justify-content-center mb-2">
        <a href="/authentication/api/oauth2Api.php" class="alt-login">
            <div class="shadow-sm border rounded p-1 d-flex">
                <div class="p-1">
                    <img src="/authentication/assets/img/google_logo.jpeg" alt="Google-logo" class="logo" width="30"
                         height="30">
                </div>
                <div class="p-1 fill">
                    <span>Prihlásiť pomocou Google účtu</span>
                </div>
            </div>
        </a>
    </div>
    <div class="flex-row d-flex justify-content-center mb-2">
        <a href="/authentication/ldapPage.php" class="alt-login">
            <div class="shadow-sm border rounded p-1 d-flex">
                <div class="p-1">
                    <img src="/authentication/assets/img/stu_logo.png" alt="Stuba-logo" class="logo" width="30"
                         height="30">
                </div>
                <div class="p-1 fill">
                    <span>Prihlásiť pomocou Stuba účtu</span>
                </div>
            </div>
        </a>
    </div>

    <div id="register-container" style="display: none">
        <div class="flex-row d-flex justify-content-center">
            <?php include __DIR__ . "/form-register.php"; ?>
        </div>
        <div class="flex-row d-flex justify-content-center mt-2">
            <p class="register-text">
                Máte už konto? <a style="color: #0d6efd" onclick="showLogin()">Prihláste sa</a>
            </p>
        </div>
    </div>
    <div id="login-container">
        <div class="flex-row d-flex justify-content-center">
            <?php include __DIR__ . "/form-login.php"; ?>
        </div>
        <div class="flex-row d-flex justify-content-center mt-2">
            <p class="register-text">
                Nemáte ešte konto? <a style="color: #0d6efd" onclick="showRegister()">Registrovať</a>
            </p>
        </div>
    </div>
    <div class="flex-row d-flex justify-content-center">
        <p class="error-text">
            <?php
            if (isset($_GET["loginError"])) {
                switch ($_GET["loginError"]) {
                    case 1:
                        echo "Prihlásenie zlyhalo: Prosím zadajte valídne prihlasovacie údaje";
                        break;
                    case 2:
                        echo "Prihlásenie zlyhalo: Prosím skontrolujte svoje prihlasovací email a heslo";
                        break;
                }
            } else if (isset($_GET["registerError"])) {
                switch ($_GET["registerError"]) {
                    case 1:
                        echo "Registrácia zlyhala: Prosím zadajte valídne údaje";
                        break;
                    case 2:
                        echo "Registrácia zlyhala: Prosím zadajte zhodujúce sa heslo s maximálnou dlžkou 16 znakov";
                        break;
                    case 3:
                        echo "Registrácia zlyhala: Konto sa daným emailom už existuje";
                        break;
                }
            }
            ?>
        </p>
    </div>
</div>
