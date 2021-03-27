<?php
require_once(__DIR__ . "/../classes/controllers/LoginAuditController.php");
$loginAuditController = new LoginAuditController();
$stats = $loginAuditController->getStats();
?>
<div class="row mt-3 mb-3">
    <header class="col-lg mb-2 site-header">
        <div class="mb-2 mt-2 d-flex flex-row">
            <div class="p-2" style="margin-left: 5%">
                <a href="https://wt98.fei.stuba.sk/authentication/"><h1 id="main-branding">Autentifikácia</h1></a>
            </div>
            <div class="p-2 d-flex" style="margin-left: auto; margin-right: 5%">
                <ul class="p-2" style="float: left">
                    <li>2FA: </li>
                    <li>OAuth 2.0: </li>
                    <li>LDAP: </li>
                </ul>
                <ul class="p-2">
                    <li><?php echo $stats["basiclogin"]; ?></li>
                    <li><?php echo $stats["oauth2"]; ?></li>
                    <li><?php echo $stats["ldap"]; ?></li>
                </ul>
            </div>
        </div>
    </header>
    <hr>
</div>