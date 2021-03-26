<?php
session_start();
require_once(__DIR__ . "/handlers/logoutHandler.php");


if (isset($_SESSION["type"])) {
    if ($_SESSION["type"] = "oauth2") {
        oatuh2Logout();
    }
}

session_destroy();

header("Location: https://wt98.fei.stuba.sk/authentication/");