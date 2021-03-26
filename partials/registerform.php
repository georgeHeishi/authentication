<?php
require_once(__DIR__ . "/../api/PHPGangsta/GoogleAuthenticator.php");

$websiteTitle = 'https://wt98.fei.stuba.sk';
$ga = new PHPGangsta_GoogleAuthenticator();

$secret = $ga->createSecret();
$qrCodeUrl = $ga->getQRCodeGoogleUrl($websiteTitle, $secret);

?>
<form method="post" id="register-form" action="/authentication/api/registerApi.php">
    <div class="row mb-2">
        <div class="form-group col">
            <label for="regName">Meno</label>
        </div>
        <div class="form-group col">
            <input type="text" name="name" id="regName" required>
        </div>
    </div>
    <div class="row mb-2">
        <div class="form-group col">
            <label for="regSurname">Priezvisko</label>
        </div>
        <div class="form-group col">
            <input type="text" name="surname" id="regSurname" required>
        </div>
    </div>
    <div class="row mb-2">
        <div class="form-group col">
            <label for="regEmail">Email</label>
        </div>
        <div class="form-group col">
            <input type="email" name="email" id="regEmail" required>
        </div>
    </div>
    <div class="row mb-2">
        <div class="form-group col">
            <label for="regPassword">Heslo</label>
        </div>
        <div class="form-group col">
            <input type="password" name="password" id="regPassword" required>
        </div>
    </div>
    <div class="row mb-2">
        <div class="form-group col">
            <label for="regPassword-verify">Zopakujte heslo</label>
        </div>
        <div class="form-group col">
            <input type="password" name="password-verify" id="regPassword-verify" required>
        </div>
    </div>
    <div class="row mb-2">
        <div class="form-group col">
            <p>Overovací kľúč: <?php echo $secret; ?></p>
            <input type="hidden" name="secret" id="regSecret" value="<?php echo $secret ?>">
        </div>
    </div>
    <div class="row mb-2">
        <div class="form-group col">
            <span>Oskenujte QR do aplikácie Google Authentificator.</span>
            <br><img src="<?php echo $qrCodeUrl; ?>" alt="QR code"/>
        </div>
    </div>
    <button type="submit" class="btn btn-light mt-3">Registrovať</button>
</form>